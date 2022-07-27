<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];
     public function category(){
        return $this->belongsTo(Category::class,'category_id');
     }
     public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subCategory_id');
     }
     public function color(){
        return $this->belongsTo(Color::class);
     }
     public function size(){
      return $this->belongsTo(Size::class);
   }
     public function subImages(){
      return $this->hasMany(ProductSubImage::class);
   }
   public function productColor(){
      return $this->hasMany(ProductColor::class);
   }
   public function productSize(){
      return $this->hasMany(ProductSize::class);
   }
}
