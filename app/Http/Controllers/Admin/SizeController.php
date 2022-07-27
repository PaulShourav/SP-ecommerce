<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SizeController extends Controller
{
    public function add(){
        return view('admin.size.add-size');
    }
    //size store....///
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:sizes,name',
        ]);
        
        $size=new size();
        $size->name=Str::upper($request->name);
        $size->save();
        return back()->with('success','Successfully added');
    }
    //Show all size Data...//
    public function view(){
        return view('admin.size.view-size',[
            'viewData'=>Size::orderBy('id','desc')->get()
        ]);
    }
    ///Edit size Data...///
    public function edit($id){
        return view('admin.size.add-size',[
            'editData'=>Size::find($id)
        ]);
    }
    //Update size data..//
    public function update(Request $request,$id){
        $size=Size::find($id);
        $size->name=Str::upper($request->name);
        $size->save();
        return redirect()->route('size.view')->with('success','Successfully updated');
    }
    //Delete size data..Not permanenetly..//
    public function trashDelete($id){
        Size::find($id)->delete();
        return back()->with('success','Successfully deleted');
    }
    //Show recacle bin Data..//
    public function viewTrash(){
        return view('admin.size.view-size',[
            'trashData'=>Size::onlyTrashed()->orderBy('id','desc')->get()
        ]);
    }
    //Permanently deleted////
    public function deletePermanently($id){
        Size::onlyTrashed()->find($id)->delete();
        return back()->with('success','Successfully deleted');
    }
    //Restore size data..//
    public function restore($id){
        Size::withTrashed()->find($id)->forceDelete();
        return back()->with('success','Successfully restored');
    }
}
