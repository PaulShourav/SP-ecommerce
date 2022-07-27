<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function add(){
        return view('admin.users.add-edit-user');
    }
    public function store(Request $request){
        // return $request->all();
        $request->validate([
            'name'=>'required',
            'mobile_number'=>'required|unique:users,mobile_number',
            'email'=>'required|unique:users,email',
            'street_address'=>'required',
            'district'=>'required',
            'police_station'=>'required',
            'password' => 'min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8'
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->user_type='Admin';
        $user->mobile_number=$request->mobile_number;
        $user->email=$request->email;
        $user->street_address=$request->street_address;
        $user->district=$request->district;
        $user->status='1';
        $user->police_station=$request->police_station;
        $user->password=bcrypt($request->password);
        $image=$request->file('image');
        if (!empty($image)) {
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/user-image/';
            $image->move($imageDirectory,$imageName);
            $user->image=$imageName;
        } else {
            $user->image=null;
        }
        $user->save();
        return back()->with('success','Successfully added');
    }
    public function verifiedUser(){
        return view('admin.users.view-user',[
            'verifiedData'=>User::where('user_type','Admin')->where('status',1)->get()
        ]);
    }
    public function unverifiedUser(){
        return view('admin.users.view-user',[
            'unverifiedData'=>User::where('user_type','Admin')->where('status',0)->get()
        ]);
    }
    public function edit($id){
        return view('admin.users.add-edit-user',[
            'editData'=>User::where('user_type','Admin')->where('id',$id)->first()
        ]);
    }
    public function active($id){
        $user=User::where('user_type','Admin')->where('id',$id)->update(['status'=>1]);
        return back()->with('success','Successfully Verified');
    }
    public function deactive($id){
        $user=User::where('user_type','Admin')->where('id',$id)->update(['status'=>0]);
        
        return back()->with('success','Successfully Unverified');
    }
    public function viewOwnProfile(){
        return view('admin.users.view-own-profile',[
            'profile'=>User::where('user_type','Admin')->where('id',Auth::user()->id)->first()
        ]);
    }
    public function passwordChange(){
        return view('admin.users.password-change');
    }
    public function passwordChangeStore(Request $request){
        $request->validate([
            'current_password'=>'required',
        ]);
        $user=User::where('user_type','Admin')->where('id',Auth::user()->id)->first();
        if(Auth::attempt(['id'=>$user->id,'password'=>$request->current_password])){
            $request->validate([
                'password' => 'required|min:8',
                'password_confirmation' => 'required|same:password|min:8'
            ]);
            $user->password=bcrypt($request->password);
            $user->save();
            return redirect('/admin')->with('success','The Password Successfully Changed');
        }else{
            return back()->with('message',"Doesn't match current password");
        }
    }
}
