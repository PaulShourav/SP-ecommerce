<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ShouravController extends Controller
{
    public function shopAll(){
      
            return view('frontend.pages.shop-product',[
                'products'=>Product::where('status',1)->get(),  
            ]);
       
  
    }
    public function showCatWiseProduct($slug){
        $category=Category::where('slug',$slug)->first();
        if ($category) {
            return view('frontend.pages.shop-product',[
                'products'=>Product::where('status',1)->where('category_id',$category->id)->get(),
                'category'=>$category
            ]);
        } else {
           abort(404);
        }
  
    }
    public function showSubCatWiseProduct($slug){
        $subCategory=SubCategory::where('slug',$slug)->first();
        if ($subCategory) {
            return view('frontend.pages.shop-product',[
                'products'=>Product::where('status',1)->where('subCategory_id', $subCategory->id)->get(),
                'subCategory'=>$subCategory
            ]);
        } else {
           abort(404);
        }
       
        
    }
    public function productDetails($slug){
        $product=Product::where('slug',$slug)->first();
        return view('frontend.pages.product-details',[
            'product'=>$product,
            'relatedProducts'=>Product::where('status',1)->where('subCategory_id',$product->subCategory_id)->take(5)->get(),
        ]);
    }
}
