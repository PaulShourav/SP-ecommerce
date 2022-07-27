<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   
    public function add(){
        return view('admin.contact.add-contact');
    }
  //Store Data.....//
    public function store(Request $request){
        $request->validate([
            'address'=>'required',
            'mobile_number'=>'required',
            'email'=>'required',
            'facebook'=>'required',
            'instagram'=>'required',
            'twitter'=>'required',
        ]);
        Contact::create($request->all());
        return back()->with('success','Successfully added');
    }
    //view data..........///
    public function view(){
        return view('admin.contact.view-contact',
        [
            'viewData'=>Contact::all(),
        ]
    );
    }
    //Trash Delete.....//
    public function trashDelete($id){
        Contact::find($id)->delete();
        return back()->with('success','Successfully Deleted');
    }
    ///Edit data......//
    public function edit($id){
        if (Contact::find($id)) {
            return view('admin.Contact.add-Contact',[
                'editData'=>Contact::find($id),
            ]);
        } else {
            abort(404);
        }
        
       
    }
    ///Update Data....//
    public function update(Request $request,$id){
        $request->validate([
            'address'=>'required',
            'mobile_number'=>'required',
            'email'=>'required',
            'facebook'=>'required',
            'instagram'=>'required',
            'twitter'=>'required',
        ]);
        $contact=Contact::find($id);
        $contact->update($request->all());
        return redirect()->route('contact.view')->with('success','Successfully Updated');
    }
    //Trash delete....////
    public function viewTrash(){
        return view('admin.Contact.view-Contact',[
            'trashData'=>Contact::onlyTrashed()->orderBy('id','desc')->get(),
        ]);
    }
    //Permanently deleted....///
    public function deletePermanently($id){
      Contact::onlyTrashed()->find($id)->forceDelete();
       return back()->with('success','Successfully Deleted');
    }
    ///Restore Data......///
    public function restore($id){
        Contact::withTrashed()->find($id)->restore();
        return back()->with('success','Restore Successfully');
    }
}
