<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded=[];
    //One to one relationship with payment//
    public function payment(){
        return $this->belongsTo(Payment::class);
    }
    //One to many rlationship with orderDetails//
    public function orderDetails(){
        return $this->hasMany(OrderDetail::class);
    }
     //
  
}
