<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    
    public function add(){
        return view('admin.banner.add-banner');
    }
  //Store Data.....//
    public function store(Request $request){
        $request->validate([
            'short_title'=>'required|unique:banners,title|max:150',
            'long_title'=>'required',
            'image'=>'required|image|mimes:png,jpg,jpeg,svg',
        ]);
        $banner=new Banner();
        $banner->short_title=$request->short_title;
        $banner->long_title=$request->long_title;
        $image=$request->file('image');
        if(!empty($image)){
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/banner-image/';
            $image->move($imageDirectory,$imageName);
            $banner->image=$imageName;
        }else{
            $banner->image=null;
        }
        $banner->save();
        return back()->with('success','Successfully added');
    }
    //view data..........///
    public function view(){
        return view('admin.banner.view-banner',
        [
            'viewData'=>Banner::all(),
        ]
    );
    }
    //Banner active///
    public function active($id)
    {
        Banner::find($id)->update(['status' => 1]);
        return back()->with('success', 'Successfully activated');
    }
    ///Banner deactive///
    public function deactive($id)
    {
        Banner::find($id)->update(['status' => 0]);
        return back()->with('success', 'Successfully deactivated');
    }
    //Trash Delete.....//
    public function trashDelete($id){
        Banner::find($id)->delete();
        return back()->with('success','Successfully Deleted');
    }
    ///Edit data......//
    public function edit($id){
        return view('admin.banner.add-banner',[
            'editData'=>Banner::find($id),
        ]);
    }
    ///Update Data....//
    public function update(Request $request,$id){
        $banner=Banner::find($id);
        $banner->short_title=$request->short_title;
        $banner->long_title=$request->long_title;
        if($request->hasFile('image')){
            //Unlink and delete old image....//
            if(File::exists('uploads/banner-image/'.$banner->image)){
                File::delete('uploads/banner-image/'.$banner->image);
            }
            //New Image save..///
            $image=$request->file('image');
            $imageName=time().'.'.$image->getClientOriginalExtension();
            $imageDirectory='uploads/banner-image/';
            $image->move($imageDirectory,$imageName);
            $banner->image=$imageName;

        }else{
            $banner->image=$request->image; 
        }
        $banner->save();
        return redirect()->route('banner.view')->with('success','Successfully Updated');
    }
    //Trash delete....////
    public function viewTrash(){
        return view('admin.banner.view-banner',[
            'trashData'=>Banner::onlyTrashed()->orderBy('id','desc')->get(),
        ]);
        
    }
    //Permanently deleted....///
    public function deletePermanently($id){
       $banner=Banner::onlyTrashed()->find($id);
       if(File::exists('uploads/banner-image/'.$banner->image)){
        File::delete('uploads/banner-image/'.$banner->image);
       }
       $banner->forceDelete();
       return back()->with('success','Successfully Deleted');
    }
    ///Restore Data......///
    public function restore($id){
        Banner::withTrashed()->find($id)->restore();
        return back()->with('success','Restore Successfully');
    }
}
