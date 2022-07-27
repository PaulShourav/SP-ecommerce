<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function pendingList(){
        return view('admin.orders.pending-approved-list',[
            'pendingData'=>Order::where('status',0)->get()
        ]);
    }
    public function approvedList(){
        return view('admin.orders.pending-approved-list',[
            'approvedData'=>Order::where('status',1)->get()
        ]);
    }
    public function approve($id){
        $oder=Order::find($id);
        $oder->status='1';
        $oder->save();
        return back()->with('success','Successfully Approved');
    }
}
