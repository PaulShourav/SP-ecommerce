<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\SentCustomer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Cart;

class CheckoutController extends Controller
{
    public function signInUp()
    {
        return view('frontend.pages.signin-up');
    }
    public function signUpStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'mobile_number' => [
                'required',
                'regex:/(^(\+8801|8801|01))/'
            ],
            'street_address' => 'required',
            'district' => 'required',
            'police_station' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ]);
        if ($validator->fails()) {
            return redirect()->route('signup')->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->user_type = "Customer";
        $user->email = $request->email;
        $user->code = rand(0000, 9999);
        $user->mobile_number = $request->mobile_number;
        $user->status = '0';
        $user->password = bcrypt($request->password);
        $user->street_address = $request->street_address;
        $user->district = $request->distirct;
        $user->police_station = $request->police_station;
        if ($user->save()) {
            Mail::to($user->email)->send(new SentCustomer($user));
            return redirect()->route('customer.email_verify', $user->id)->with('success', 'Successfully Signed Up,Please Verify your Email.');
        }
    }
    public function emailVerify()
    {
        return view('frontend.emails.email-verify');
    }
    public function emailVerifyStore(Request $request)
    {
        
       $request->validate([
        'email'=>'required',
        'code'=>'required',
       ],[
        'code.required'=>'Please enter 4 digit verify code.'
       ]);
       
       $check=User::where('email',$request->email)->where('code',$request->code)->first();
       if ($check) {
        $check->status='1';
        $check->save();
        return redirect("/")->with('success', 'You have successfully verified,Please Sing in');
    } else {
        return back()->with('message', 'This Verificaton code is incorrect');
    }
    }
    public function checkout(){
        return view('frontend.pages.checkout',[
            'user'=>User::find(Auth::user()->id),
        ]);
    }
    public function checkoutStore(Request $request){
        
        
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'mobile_number' => 'required',
            'street_address' => 'required',
            'district' => 'required',
            'police_station' => 'required',
            'method' => 'required',
        ]);
        $method = Validator::make($request->all(), [
            'method' => 'required',
        ]);

        // if(Cart::session(Auth::user()->id)->isEmpty()){
        //     return redirect('/')->with('success','Please add product.');
        // }else{
            if ($request->shipping_status == '1') {
                if ($validator->fails()) {
                    return redirect()->route('checkout_active')->withErrors($validator)->withInput();
                }
                $shipping = new Shipping();
                $shipping->user_id = Auth::user()->id;
                $shipping->name = $request->name;
                $shipping->mobile_number = $request->mobile_number;
                $shipping->street_address = $request->street_address;
                $shipping->district = $request->district;
                $shipping->police_station = $request->policeStation;
                $shipping->save();
            } elseif ($request->shipping_status == '0') {
                if ($method->fails()) {
                    return redirect()->route('checkout')->withErrors($validator)->withInput();
                }
                $shipping = new Shipping();
                $shipping->user_id = Auth::user()->id;
                $shipping->name = Auth::user()->name;
                $shipping->email = Auth::user()->email;
                $shipping->mobile_number = Auth::user()->mobile_number;
                $shipping->street_address = Auth::user()->street_address;
                $shipping->district = Auth::user()->district;
                $shipping->police_station = Auth::user()->police_station;
                $shipping->save();
            }
    
            $payment = new Payment();
            $payment->payment_method = $request->method;
    
            $payment->save();
    
            $cartCollections = Cart::getContent();
    
            $order = new Order();
            $order->user_id = Auth::user()->id;
            $order->shipping_id = $shipping->id;
            $order->payment_id = $payment->id;
            $order_data = Order::orderBy('id', 'desc')->first();
            if ($order_data == null) {
                $first_reg = '0';
                $order_no = $first_reg + 1;
            } else {
                $order_data = Order::orderBy('id', 'desc')->first()->order_on;
                $order_no = $order_data + 1;
            }
            $order->order_no = $order_no;
            $order->order_total = Cart::getSubTotal();
            $order->status = '0';
            $order->save();
            foreach ($cartCollections as $cartCollection) {
                $orderdetails = new OrderDetail();
                $orderdetails->order_id = $order->id;
                $orderdetails->product_id = $cartCollection->id;
                $orderdetails->color_id = $cartCollection->attributes->color_id;
                $orderdetails->size_id = $cartCollection->attributes->size_id;
                $orderdetails->quantity = $cartCollection->quantity;
                $orderdetails->save();
            }
        // }
       Cart::clear();
       return redirect()->route('customer.order_list')->with('success','Order Successfully cmpleted');
    }
}
