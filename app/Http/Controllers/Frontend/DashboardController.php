<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        return view('frontend.pages.my-account', [
            'user' => User::find(Auth::user()->id),
            'orders'=>Order::where('user_id',Auth::user()->id)->get(),
        ]);
    }
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ]);
        
    
        if (Auth::attempt(['id' => Auth::user()->id, 'password' => $request->curren_password])) {
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect('/')->with('success', 'Successfully changed password');
        } else {
            return redirect()->route('customer.password_change')->with('message', 'Sorry!, Your dose not match');
        }
    }
    public function orderDestails($id){
       $orderFind=Order::find($id);
        $order=Order::where('user_id',Auth::user()->id)->where('id',$orderFind->id)->first();
        if ($order==true) {
            return view('frontend.pages.my-account',[
                'user' => User::find(Auth::user()->id),
                'orders'=>Order::where('user_id',Auth::user()->id)->get(),
                'order'=>Order::where('id',$orderFind->id)->where('user_id',Auth::user()->id)->first(),
                'orderDetails'=>OrderDetail::where('order_id',$order->id)->get()
            ]);
        } else {
            return back();
        }
        
        
    }
}
