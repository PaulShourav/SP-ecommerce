@extends('frontend.master')
@section('title', 'Checkout')
{{-- @section('body')
@php
    $route=Route::current()->getName();
@endphp
    <div class="checkout-main-area pb-100 pt-100">
        <div class="container">
            <div class="customer-zone mb-20">
                <p class="cart-page-title">Returning customer? <a class="checkout-click1" href="#">Click here to
                        login</a></p>
                <div class="checkout-login-info">
                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new
                        customer, please proceed to the Billing & Shipping section.</p>
                    <form action="#">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="sin-checkout-login">
                                    <label>Username or email address <span>*</span></label>
                                    <input type="text" name="user-name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="sin-checkout-login">
                                    <label>Passwords <span>*</span></label>
                                    <input type="password" name="user-password">
                                </div>
                            </div>
                        </div>
                        <div class="button-remember-wrap">
                            <button class="button" type="submit">Login</button>
                            <div class="checkout-login-toggle-btn">
                                <input type="checkbox">
                                <label>Remember me</label>
                            </div>
                        </div>
                        <div class="lost-password">
                            <a href="#">Lost your password?</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="customer-zone mb-20">
                <p class="cart-page-title">Have a coupon? <a class="checkout-click3" href="#">Click here to enter your
                        code</a></p>
                <div class="checkout-login-info3">
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <input type="submit" value="Apply Coupon">
                    </form>
                </div>
            </div>

            <div class="checkout-wrap pt-30">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3 class="mb-4">Billing Details</h3>
                            <form id="checkout-store" action="{{ route('checkout_store') }}" method="post">
                                @csrf
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="fs-5 border-bottom border-warning mb-3">

                                        Select Shipping address

                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" {{$route=='checkout_active'? '':'checked'}} name="shipping_status" value="0" id="radio1"
                                            checked type="radio" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseOne">
                                        <label class="form-check-label">

                                            <a data-bs-toggle="collapse"
                                                onclick="document.getElementById('radio1').checked = true;"
                                                href="#flush-collapseOne">User Address</a>
                                        </label>
                                    </div>

                                    <div id="flush-collapseOne" class="accordion-collapse collapse  {{$route=='checkout_active'? '':'show'}}"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <table class="table" id="multiCollapseExample1">
                                            <tbody>
                                                <tr>
                                                    <td>User Name: </td>
                                                    <td>{{ $user->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td> Email:</td>
                                                    <td>{{ $user->email }}</td>
                                                </tr>
                                                <tr>
                                                    <td> Mobile Number:</td>
                                                    <td>{{ $user->mobile_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Street Address: </td>
                                                    <td>{{ $user->street_address }}</td>
                                                </tr>
                                                <tr>
                                                    <td> District:</td>
                                                    <td>{{ $user->district }}</td>
                                                </tr>
                                                <tr>
                                                    <td> Police Station:</td>
                                                    <td>{{ $user->police_station }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input"  {{$route=='checkout_active'? 'checked':''}} name="shipping_status" value="1" type="radio"
                                            id="radio2" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo">
                                        <label class="form-check-label">

                                            <a data-bs-toggle="collapse"
                                                onclick="document.getElementById('radio2').checked = true;"
                                                href="#flush-collapseTwo">Ship to a different address?</a>
                                        </label>
                                    </div>

                                    <div id="flush-collapseTwo" class="accordion-collapse collapse {{$route=='checkout_active'? 'show':''}}"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">

                                        <div class="billing-info-wrap mt-30">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="billing-info mb-20">
                                                        <label>Name:<span class="text-danger">*</span></label>
                                                        <input type="text" name="name">
                                                        @error('name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="col-lg-8">
                                                    <div class="billing-info mb-20">
                                                        <label>Mobile Number: <span class="text-danger">*</span></label>
                                                        <input type="text" name="mobile_number">
                                                        @error('mobile_number')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            
                                                <div class="col-lg-8">
                                                    <div class="billing-info mb-20">
                                                        <label>Street Address:<span class="text-danger">*</span></label>
                                                        <input class="billing-address" name="street_address"
                                                            placeholder="House number and street name" type="text">
                                                            @error('street_address')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info mb-20">
                                                        <label>District:<span class="text-danger">*</span></label>
                                                        <input type="text" name="district">
                                                        @error('district')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div class="billing-info mb-20">
                                                        <label>Police Station:<span class="text-danger">*</span></label>
                                                        <input type="text" name="police_station">
                                                        @error('police_station')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                        </div>

                      
                    </div>
                    <div class="col-lg-5">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-info-wrap">
                                    <div class="your-order-info">
                                        <ul>
                                            <li>Product <span>Total</span></li>
                                        </ul>
                                    </div>

                                    <div class="your-order-info order-subtotal">
                                        <ul>
                                            <li>Subtotal <span>{{ Cart::getSubTotal() }}TK</span></li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-shipping">
                                        <ul>
                                            <li>Shipping <p>Enter your full address </p>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="your-order-info order-total">
                                        <ul>
                                            <li>Total <span>$273.00 </span></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="payment-method">

                                    <div class="pay-top sin-payment">
                                        <input id="payment-method-3" class="input-radio" type="radio"
                                            value="Cash on delivery" name="method">
                                        <label for="payment-method-3">Cash on delivery </label>
                                        <div class="payment-box payment_method_bacs">
                                            <p>Make your payment directly into our bank account. Please use your Order ID as
                                                the payment reference.</p>
                                        </div>
                                        
                                    </div>
                                    <div class="pay-top sin-payment sin-payment-3">
                                        <input id="payment-method-4" class="input-radio" type="radio"
                                            value="Bikash Payment " name="method">
                                        <label for="payment-method-4">Bikash Payment </label>
                                        <div class="payment-box payment_method_bacs ">
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    @error('method')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            </form>
                            <div class="Place-order btn-hover">
                                <a href="{{ route('checkout_store') }}"
                                    onclick="event.preventDefault();
                            document.getElementById('checkout-store').submit();">Place
                                    Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}
@section('body')
    @php
    $route = Route::current()->getName();
    @endphp
    <main class="main">
        <div class="page-header text-center"
            style="background-image: url('{{ asset('front-assets') }}/images/page-header-bg.jpg')">
            <div class="container">
                <h1 class="page-title">Checkout<span>Shop</span></h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Shop</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="checkout">
                <div class="container">
                    <div class="checkout-discount">
                        <form action="#">
                            <input type="text" class="form-control" required id="checkout-discount-input">
                            <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to
                                    enter your code</span></label>
                        </form>
                    </div><!-- End .checkout-discount -->
                    <form id="checkout-store" action="{{ route('checkout_store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-9">
                                <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                               
                                <div class="accordion accordion-icon" id="accordion-3">
                                   
                                     <div class="card">
                                        <div class="card-header" id="heading3-1">
                                            <h5 class="mt-3">
                                                <input class="form-check-input ml-1"
                                                {{ $route == 'checkout_active' ? '' : 'checked' }} name="shipping_status"
                                                value="0" id="radio1" checked type="radio">

                                                <a role="button" data-toggle="collapse" onclick="document.getElementById('radio1').checked = true;" href="#collapse3-1"
                                                    aria-expanded="true" aria-controls="collapse3-1">
                                                    <span
                                                        class="ml-5"> User address.</span>
                                                </a>

                                              

                                            </h2>
                                        </div><!-- End .card-header -->
                                        <div id="collapse3-1" class="collapse {{$route=='checkout_active'? '':'show'}}" aria-labelledby="heading3-1"
                                            data-parent="#accordion-3">
                                            <div class="card-body">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>User Name: </td>
                                                            <td>{{ $user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Email:</td>
                                                            <td>{{ $user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Mobile Number:</td>
                                                            <td>{{ $user->mobile_number }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Street Address: </td>
                                                            <td>{{ $user->street_address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> District:</td>
                                                            <td>{{ $user->district }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Police Station:</td>
                                                            <td>{{ $user->police_station }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->

                                    <div class="card">
                                        <div class="card-header" id="heading3-2">
                                            <h5 class="mt-3">
                                                <input class="form-check-input ml-1"  {{$route=='checkout_active'? 'checked':''}} name="shipping_status" value="1" type="radio"
                                                    id="radio2" >
                                                <a class="collapsed" role="button" data-toggle="collapse" onclick="document.getElementById('radio2').checked = true;" href="#collapse3-2" aria-expanded="false" aria-controls="collapse3-2">
                                                    <span class="ml-5">Ship to a different address
                                                </a>
                                            </h5>
                                        </div><!-- End .card-header -->
                                        <div id="collapse3-2" class="collapse {{$route=='checkout_active'? 'show':''}}" aria-labelledby="heading3-2" data-parent="#accordion-3">
                                            <div class="card-body">
                                                
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4">
                                                            
                                                                <label>Name:<span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="name">
                                                                @error('name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                           
                                                        </div>
            
                                                        <div class="col-lg-8">
                                                            
                                                                <label>Mobile Number: <span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="mobile_number">
                                                                @error('mobile_number')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                            
                                                        </div>
                                                    
                                                        <div class="col-lg-8">
                                                            
                                                                <label>Street Address:<span class="text-danger">*</span></label>
                                                                <input class="form-control" class="billing-address" name="street_address"
                                                                    placeholder="House number and street name" type="text">
                                                                    @error('street_address')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                        
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                           
                                                                <label>District:<span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="district">
                                                                @error('district')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                           
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            
                                                                <label>Police Station:<span class="text-danger">*</span></label>
                                                                <input class="form-control" type="text" name="police_station">
                                                                @error('police_station')
                                                                <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                         
                                                        </div>
                                                    </div>
                                             
                                            </div><!-- End .card-body -->
                                        </div><!-- End .collapse -->
                                    </div><!-- End .card -->


                                </div><!-- End .accordion --> 
                            </div><!-- End .col-lg-9 -->
                            <aside class="col-lg-3">
                                <div class="summary">
                                    <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                    <table class="table table-summary">
                                       

                                        <tbody>
                                            
                                            {{-- <tr class="summary-subtotal">
                                                <td>Subtotal:</td>
                                                <td>{{Cart::getSubTotal()}}Tk</td>
                                            </tr><!-- End .summary-subtotal --> --}}
                                            <tr>
                                                <td>Shipping:</td>
                                                <td>Free shipping</td>
                                            </tr>
                                            <tr class="summary-total">
                                                <td>Total:</td>
                                                <td>{{Cart::getSubTotal()}}Tk</td>
                                            </tr><!-- End .summary-total -->
                                        </tbody>
                                    </table><!-- End .table table-summary -->
                                    @error('method')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                    <div class="accordion-summary" id="accordion-payment">
                                        <div class="card">
                                            <div class="card-header" id="heading-1">
                                                <h5 class="">
                                                    <input  class="form-check-input" type="radio"
                                                        value="Cash On Delivery" id="radio3" name="method">
                                                    <a role="button" data-toggle="collapse"  onclick="document.getElementById('radio3').checked = true;" href="#collapse-1"
                                                        aria-expanded="true" aria-controls="collapse-1">
                                                        <span class="ml-3"> Cash On Delivery
                                                    </a>
                                                </h5>
                                            </div><!-- End .card-header -->
                                            <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                                data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment reference. Your order will not be shipped until the
                                                    funds have cleared in our account.
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                        <div class="card">
                                            <div class="card-header" id="heading-2">
                                                <h5 class="">
                                                    <input  class="form-check-input" type="radio"
                                                        value="Bikash Payment "  id="radio4" name="method">
                                                    <a class="collapsed" role="button" data-toggle="collapse"
                                                      onclick="document.getElementById('radio4').checked = true;"  href="#collapse-2" aria-expanded="false"
                                                        aria-controls="collapse-2">
                                                        <span class="ml-3"> Bikash payment
                                                    </a>
                                                </h5>
                                            </div><!-- End .card-header -->
                                            <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                                data-parent="#accordion-payment">
                                                <div class="card-body">
                                                    Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque
                                                    volutpat mattis eros. Nullam malesuada erat ut turpis.
                                                </div><!-- End .card-body -->
                                            </div><!-- End .collapse -->
                                        </div><!-- End .card -->

                                      

                            
                                    </div><!-- End .accordion -->

                                    <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                        <span class="btn-text">Place Order</span>
                                        <span class="btn-hover-text">Proceed to Checkout</span>
                                    </button>
                                </div><!-- End .summary -->
                            </aside><!-- End .col-lg-3 -->
                        </div><!-- End .row -->
                    </form>
                </div><!-- End .container -->
            </div><!-- End .checkout -->
        </div><!-- End .page-content -->
    </main><!-- End .main -->
@endsection

@push('scripts')
    <script>
        $('[name="shipping_status"]').on('change', function() {
            if ($(this).val() === "yes") {
                $('#collapse3-1').collapse('show').checked = true;
            } else {
                $('#collapse3-2').collapse('hide').checked = false;
            }
        });
        $('[name="method"]').on('change', function() {
            if ($(this).val() === "yes") {
                $('#collapse1').collapse('show').checked = true;
            } else {
                $('#collapse2').collapse('hide').checked = false;
            }
        });
    </script>
    {{-- <script>
        $('.collapse').collapse()
    </script> --}}
@endpush
