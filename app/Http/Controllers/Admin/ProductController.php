<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductSubImage;
use App\Models\Size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function add()
    {
        return view('admin.product.add-product', [
            'categories' => Category::all(),
            'subCategories' => SubCategory::all(),
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }
    public function getSubCategoryId($id)
    {
        $subCategories = SubCategory::where('category_id', $id)->get();
        return json_encode($subCategories);
    }
    //product store....///
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|unique:products,name',
                'category_id' => 'required',
                'subCategory_id' => 'required',
                'quantity' => 'required',
                'regular_price' => 'required',
                'special_price' => 'required',
                'image' => 'required',
                'sub_image' => 'required',
                'description' => 'required',

            ],
            [
                'name.required' => 'Enter Product name.',
                'name.unique' => ' Already this Product name has been added.Please enter another name.',
                'category_id.required' => 'Please select Category name.',
                'subCategory_id.required' => 'Please select SubCat name.',
                'quantity.required' => 'Enter Product quntity.',
                'regular_price.required' => 'Enter Product regular price.',
                'special_price.required' => 'Enter Product speacial price.',
                'image.required' => 'Please select Product Image.',
                'sub_image.required' => 'Please select Product sub Image.',
            ]
        );
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->subCategory_id = $request->subCategory_id;
        $product->tag_title = $request->tag_title;
        $product->quantity = $request->quantity;
        $product->regular_price = $request->regular_price;
        $product->special_price = $request->special_price;
        $product->description = $request->description;
        $product->additional_info = $request->additional_info;
        //Product image store///
        $image = $request->file('image');
        if (!empty($image)) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectory = 'uploads/product-image/';
            $image->move($imageDirectory, $imageName);
            $product->image = $imageName;
        }
        if ($product->save()) {
            //Product sub images store//
            $subImages = $request->sub_image;
            if (!empty($subImages)) {
                foreach ($subImages as $subImage) {
                    $imageName = rand(0000, 9999) . '.' . $subImage->getClientOriginalExtension();
                    $imageDirectory = 'uploads/product-image/sub-image/';
                    $subImage->move($imageDirectory, $imageName);
                    $productSubImage = new ProductSubImage();
                    $productSubImage->product_id = $product->id;
                    $productSubImage->sub_image = $imageName;
                    $productSubImage->save();
                }
            }
            //Product colors store//
            $colors = $request->color_id;
            if (!empty($colors)) {
                foreach ($colors as $color) {
                    $productColor = new ProductColor();
                    $productColor->product_id = $product->id;
                    $productColor->color_id = $color;
                    $productColor->save();
                }
            }
            //Product Sizes store//
            $sizes = $request->size_id;
            if (!empty($sizes)) {
                foreach ($sizes as $size) {
                    $productSize = new ProductSize();
                    $productSize->product_id = $product->id;
                    $productSize->size_id = $size;
                    $productSize->save();
                }
            }
            return back()->with('success', 'Successfully Added');
        } else {
            return back()->with('success', 'Opps ..Data not saved');
        }
    }
    //Show all product Data...//
    public function view()
    {
        return view('admin.product.view-product', [
            'viewData' => Product::orderBy('id', 'desc')->get()
        ]);
    }
    //Product active///
    public function active($slug)
    {
        Product::where('slug',$slug)->first()->update(['status' => 1]);
        return back()->with('success', 'Successfully product activated');
    }
    ///product deactive///
    public function deactive($slug)
    {
        Product::where('slug',$slug)->first()->update(['status' => 0]);
        return back()->with('success', 'Successfully product deactivated');
    }
    //Show product details///
    public function details($slug)
    {
        $product =Product::find($slug);
        return view('admin.product.details-product', [
            'product' => $product,
            'colors' => ProductColor::where('product_id', $product->id)->get(),
            'sizes' => ProductSize::where('product_id', $product->id)->get(),
            'subImages' => ProductSubImage::where('product_id', $product->id)->get(),
        ]);
    }
    ///Edit product Data...///
    public function edit($slug)
    {
        if (Product::where('slug',$slug)->first()) {
            $product=Product::where('slug',$slug)->first();
            return view('admin.product.add-product', [
                'editData' =>  $product ,
                'categories' => Category::all(),
                'subCategories' => SubCategory::all(),
                'colors' => Color::all(),
                'sizes' => Size::all(),
                'subImages' => ProductSubImage::where('product_id',$product->id)->get(),
                'colorArray' => ProductColor::select('color_id')->where('product_id',$product->id)->get()->toArray(),
              
                'sizeArray' => ProductSize::select('size_id')->where('product_id', $product->id)->get()->toArray(),
            ]);
        } else {
            abort(404);
        }
        
    }
    //Update product data..//
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->category_id = $request->category_id;
        $product->subCategory_id = $request->subCategory_id;
        $product->tag_title = $request->tag_title;
        $product->quantity = $request->quantity;
        $product->regular_price = $request->regular_price;
        $product->special_price = $request->special_price;
        $product->description = $request->description;
        $product->additional_info = $request->additional_info;

        if ($request->hasFile('image')) {
            //unlink Image///
            if (File::exists('uploads/product-image/' . $product->image)) {
                File::delete('uploads/product-image/' . $product->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imageDirectory = 'uploads/product-image/';
            $image->move($imageDirectory, $imageName);
            $product->image = $imageName;
        } else {
            $product->image = $product->image;
        }
        if ($product->save()) {
            //Product sub Image insert
            $images = $request->sub_image;
            if (!empty($images)) {
                $subImages = ProductSubImage::where('product_id', $product->id)->get();
                //unlink subimages////
                foreach ($subImages as $value) {
                    if (File::exists('uploads/product-image/sub-image/' .$value->sub_image)) {
                        File::delete('uploads/product-image/sub-image/' .$value->sub_image);
                    }
                    ProductSubImage::where('product_id', $product->id)->forceDelete();
                }
            }
            if (!empty($images)) {
                foreach ($images as $image) {
                    $imageName = 'p-subimg' . rand(000, 999) . '.' . $image->getClientOriginalExtension();
                    $imageDirectory = 'uploads/product-image/sub-image/';
                    $image->move($imageDirectory, $imageName);
                    $subImage = new ProductSubImage();
                    $subImage->product_id = $product->id;
                    $subImage->sub_image = $imageName;
                    $subImage->save();
                }
            }
            //product Color update
            $colors = $request->color_id;
            if (!empty($colors)) {
                ProductColor::where('product_id', $product->id)->forceDelete();
            }
            if (!empty($colors)) {
                foreach ($colors as $value) {
                    $color = new ProductColor();
                    $color->product_id = $product->id;
                    $color->color_id = $value;
                    $color->save();
                }
            }
            //Product Size update
            $sizes = $request->size_id;
            if (!empty($sizes)) {
                ProductSize::where('product_id', $product->id)->forceDelete();
            }
            if (!empty($sizes)) {
                foreach ($sizes as $value) {
                    $size = new ProductSize();
                    $size->product_id = $product->id;
                    $size->size_id = $value;
                    $size->save();
                }
            }
            return redirect()->route('product.view')->with('success', 'Successfully updated');
        } else {
            return back()->with('message', 'Sorry..Data not saved');
        }

      
        
    }
    //Delete product data..Not permanenetly..//
    public function trashDelete($slug)
    {
        $product=Product::where('slug',$slug)->first();
        //dd($product);
        ProductSize::where('product_id', $product->id)->delete();
        ProductColor::where('product_id', $product->id)->delete();
        ProductSubImage::where('product_id',$product->id)->delete();
        $product->delete();
        return back()->with('success', 'Successfully deleted');
    }
    //Show recacle bin Data..//
    public function viewTrash()
    {
        return view('admin.product.view-product', [
            'trashData' => product::onlyTrashed()->orderBy('id', 'desc')->get()
        ]);
    }
    //Permanently deleted////
    public function deletePermanently($slug)
    {
        $product = product::onlyTrashed()->find($slug);
        //Unlink product image///
        if (File::exists('uploads/product-image/', $product->image)) {
            File::delete('uploads/product-image/ub-image/', $product->image);
        }
        $product->forceDelete();
        ProductSize::onlyTrashed()->where('product_id', $product->id)->forceDelete();
        ProductColor::onlyTrashed()->where('product_id', $product->id)->forceDelete();
        $subImages = ProductSubImage::where('product_id', $product->id)->get();
        //Unlink product sub images/////
        foreach ($subImages as $subImage) {
            if (File::exists('uploads/product-image/sub-image/', $subImage->sub_image)) {
                File::delete('uploads/product-image/sub-image/', $subImage->sub_image);
            }
        }
        $subImages->forceDelete();
        return back()->with('success', 'Successfully deleted');
    }
    //Restore product data..//
    public function restore($slug)
    {
        $product=Product::withTrashed()->where('slug',$slug)->first();
        ProductColor::withTrashed()->where('product_id', $product->id)->restore();
        ProductSize::withTrashed()->where('product_id', $product->id)->restore();
        ProductSubImage::withTrashed()->where('product_id', $product->id)->restore();
        $product->restore();
        return back()->with('success', 'Successfully restored');
    }
}
