<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductColor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded=[];

    //One tp one relationship with color///
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
