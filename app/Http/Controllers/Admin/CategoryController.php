<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    public function add(){
        return view('admin.category.add-category');
    }
  //Store Data.....//
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:categories,name'
        ]);
        $category=new Category();
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);
        $category->description=$request->description;
        $image=$request->file('image');
        if(!empty($image)){
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/cat-image/';
            $image->move($imageDirectory,$imageName);
            $category->image=$imageName;
        }else{
            $category->image=null;
        }
        $category->save();
        return back()->with('success','Successfully added');
    }
    //view data..........///
    public function view(){
        return view('admin.category.view-category',
        [
            'viewData'=>Category::all(),
        ]
    );
    }
    //Trash Delete.....//
    public function trashDelete($id){
        Category::find($id)->delete();
        return back()->with('success','Successfully Deleted');
    }
    ///Edit data......//
    public function edit($slug){
        if (Category::where("slug",$slug)->first()) {
            return view('admin.category.add-category',[
                'editData'=>Category::where("slug",$slug)->first(),
            ]);
        } else {
            abort(404);
        }
        
       
    }
    ///Update Data....//
    public function update(Request $request,$id){
        $category=Category::find($id);
        $category->name=$request->name;
        $category->slug=Str::slug($request->name);
        $category->description=$request->description;
        if($request->hasFile('image')){
            //Unlink and delete old image....//
            if(File::exists('uploads/cat-image/'.$category->image)){
                File::delete('uploads/cat-image/'.$category->image);
            }
            //New Image save..///
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/cat-image/';
            $image->move($imageDirectory,$imageName);
            $category->image=$imageName;

        }else{
            $category->image=$request->image; 
        }
        $category->save();
        return redirect()->route('category.view')->with('success','Successfully Updated');
    }
    //Trash delete....////
    public function viewTrash(){
        return view('admin.category.view-category',[
            'trashData'=>Category::onlyTrashed()->orderBy('id','desc')->get(),
        ]);
    }
    //Permanently deleted....///
    public function deletePermanently($id){
       $category=Category::onlyTrashed()->find($id);
       if(File::exists('uploads/cat-image/'.$category->image)){
        File::delete('uploads/cat-image/'.$category->image);
       }
       $category->forceDelete();
       return back()->with('success','Successfully Deleted');
    }
    ///Restore Data......///
    public function restore($id){
        Category::withTrashed()->find($id)->restore();
        return back()->with('success','Restore Successfully');
    }
}
