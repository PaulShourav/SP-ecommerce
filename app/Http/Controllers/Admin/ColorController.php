<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

use function Ramsey\Uuid\v1;

class ColorController extends Controller
{
    public function add(){
        return view('admin.color.add-color');
    }
    //Color store....///
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:colors,name',
            'color_code'=>'required'
        ]);
        $color=new Color();
        $color->name=$request->name;
        $color->color_code=$request->color_code;
        $color->save();
        return back()->with('success','Successfully added');
    }
    //Show all color Data...//
    public function view(){
        return view('admin.color.view-color',[
            'viewData'=>Color::orderBy('id','desc')->get()
        ]);
    }
    ///Edit Color Data...///
    public function edit($id){
        return view('admin.color.add-color',[
            'editData'=>Color::find($id)
        ]);
    }
    //Update color data..//
    public function update(Request $request,$id){
        $color=Color::find($id);
        $color->name=$request->name;
        $color->color_code=$request->color_code;
        $color->save();
        return redirect()->route('color.view')->with('success','Successfully updated');
    }
    //Delete color data..Not permanenetly..//
    public function trashDelete($id){
        Color::find($id)->delete();
        return back()->with('success','Successfully deleted');
    }
    //Show recacle bin Data..//
    public function viewTrash(){
        return view('admin.color.view-color',[
            'trashData'=>Color::onlyTrashed()->orderBy('id','desc')->get()
        ]);
    }
    //Permanently deleted////
    public function deletePermanently($id){
        Color::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success','Successfully deleted');
    }
    //Restore color data..//
    public function restore($id){
        Color::withTrashed()->find($id)->restore();
        return back()->with('success','Successfully restored');
    }
}
