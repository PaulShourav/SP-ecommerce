<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    //One-to-One relasionship with Category...//
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
