<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SubCategoryController extends Controller
{
    public function add(){
        return view('admin.subCategory.add-subCat',[
            'categories'=>Category::all(),
        ]);
    }

    //Sub Cat details store....!!//
    public function store(Request $request){
        $request->validate([
            'name'=>'required|unique:sub_categories,name',
            'category_id'=>'required'
        ],[
            'name.required'=>'Enter SubCat name.',
            'category_id.required'=>'Select category name. ' 
        ]
    
    );
        $subCat=new SubCategory();
        $subCat->name=$request->name;
        $subCat->category_id=$request->category_id;
        $subCat->description=$request->description;

        //Image Save....//
        $image=$request->file('image');
        if (!empty($image)) {
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/subCat-image/';
            $image->move($imageDirectory,$imageName);
            $subCat->image=$imageName;
        }else{
            $subCat->image=null;
        }
        $subCat->save();
        return back()->with('success','Successfully Addeed');
    }
    //View All Data.....!!!//
    public function view(){
        return view('admin.subCategory.view-subCat',[
            'viewData'=>SubCategory::orderBy('id','desc')->get()
        ]);
    }
    ///Edit data...///
    public function edit($slug){
        if (SubCategory::where('slug',$slug)->first()) {
            return view('admin.subCategory.add-subCat',[
                'categories'=>Category::all(),
                'editData'=>SubCategory::where('slug',$slug)->first()
            ]);
        } else {
            abort(404);
        }
        
        
    }
    //SubCat details Update...//
    public function update(Request $request,$id){
        $subCat=SubCategory::find($id);
        $subCat->name=$request->name;
        $subCat->category_id=$request->category_id;
        $subCat->description=$request->description;

        if($request->hasFile('image')){
            //Unlink and delete old image....//
            if(File::exists('uploads/subCat-image/'.$subCat->image)){
                File::delete('uploads/subCat-image/'.$subCat->image);
            }
            //New image save..//
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/subCat-image/';
            $image->move($imageDirectory,$imageName);
            $subCat->image=$imageName;
        }else{
            $subCat->image=$request->image;
        }
        $subCat->save();
        return redirect()->route('subCategory.view')->with('success','Succesfully updated');
    }
    //Trash delete...//
    public function trashDelete($id){
        SubCategory::find($id)->delete();
        return back()->with('succes','Successfully deleted');
    }
    //View Recaycle bin Data.....//
    public function viewTrash(){
        return view('admin.subCategory.view-subCat',[
            'trashData'=>SubCategory::onlyTrashed()->orderBy('id','desc')->get()
        ]);
    }
    ///Restore Data....///
    public function restore($id){
        SubCategory::withTrashed()->find($id)->restore();
        return back()->with('success','Successfully Restored');
    }
    ///Permanently Deleted..//
    public function deletePermanently($id){
        $subCat=SubCategory::onlyTrashed()->find($id);
        if (File::exists('uploads/subCat-image/'.$subCat->image)) {
            File::delete('uploads/subCat-image/'.$subCat->image);
        }
        $subCat->delete();
        return back()->with('success','Succesfully deleted');
    }
    
}
