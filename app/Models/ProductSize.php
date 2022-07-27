<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSize extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    //One tp one relationship with size///
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
