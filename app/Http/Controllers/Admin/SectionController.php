<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{
     public function add(){
        return view('admin.section.add-edit-section',[
            'categories'=>Category::all()
        ]);
    }
  //Store Data.....//
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:sections,name',
            'category_id'=>'required'
        ],[
            'category_id.required'=>'Select category name.'
        ]);
        $section=new Section();
        $section->name=$request->name;
        $section->slug=Str::slug($request->name);
        $section->category_id=$request->category_id;
        $section->save();
        return back()->with('success','Successfully added');
    }
    //view data..........///
    public function view(){
        return view('admin.section.view-section',
        [
            'viewData'=>Section::all(),
        ]
    );
    }
     //Section active///
     public function active($id)
     {
         Section::find($id)->update(['status' => 1]);
         return back()->with('success', 'Successfully activated');
     }
     ///Section deactive///
     public function deactive($id)
     {
         Section::find($id)->update(['status' => 0]);
         return back()->with('success', 'Successfully deactivated');
     }
    //Trash Delete.....//
    public function trashDelete($id){
        Section::find($id)->delete();
        return back()->with('success','Successfully Deleted');
    }
    ///Edit data......//
    public function edit($slug){
        if (Section::where('slug',$slug)->first()) {
            return view('admin.section.add-edit-section',[
                'editData'=>Section::where('slug',$slug)->first(),
                'categories'=>Category::all()
            ]);
        } else {
            abort(404);
        }
        
       
    }
    ///Update Data....//
    public function update(Request $request,$id){
        $section=Section::find($id);
        $section->name=$request->name;
        $section->slug=Str::slug($request->name);
        $section->category_id=$request->category_id;
        $section->save();
        return redirect()->route('section.view')->with('success','Successfully Updated');
    }
    //Trash delete....////
    public function viewTrash(){
        return view('admin.section.view-section',[
            'trashData'=>Section::onlyTrashed()->orderBy('id','desc')->get(),
        ]);
    }
    //Permanently deleted....///
    public function deletePermanently($id){
       Section::onlyTrashed()->find($id)->forceDelete();

       return back()->with('success','Successfully Deleted');
    }
    ///Restore Data......///
    public function restore($id){
        Section::withTrashed()->find($id)->restore();
        return back()->with('success','Restore Successfully');
    }
}
