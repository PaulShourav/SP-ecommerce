<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;
use Darryldecode\Cart\Cart as CartCart;

class CartController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
        ],[
            'color_id.required'=>'Please select product color.',
            'size_id.required'=>'Please select product size.',
        ]);
        $product=Product::where('slug',$request->slug)->first();
        Cart::add([
            'id' => $product->id,
            'name' =>$product->name,
            'price' => $product->regular_price,
            'quantity' => $request->quantity,
            'attributes' => [
                'image'=>$product->image,
                'color_id'=>$request->color_id,
                'size_id'=>$request->size_id,
                'slug'=>$request->slug
            ]
        ]);
        return back();
    }
    public function viewShoppingCart(){
        return view('frontend.pages.shopping-cart');
    }
    public function update(Request $request,$id){
        Cart::update($id,['quantity'=>['relative' => false,'value'=>$request->quantity]]);
        return back()->with('success','Successfully Updated');
    }
    public function delete($id){
        Cart::remove($id);
        return back();
    }
}
