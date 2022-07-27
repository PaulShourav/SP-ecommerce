@extends('frontend.master')
@section('title', 'My account')
{{-- @section('body')
    <!-- my account wrapper start -->
    <div class="my-account-wrapper pb-100 mt-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card  mb-4">
                        <div class="card-header">
                            <h3>My Acount</h3>
                        </div>
                    </div>
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">
                                    @php
                                        $route = Route::current()->getName();
                                    @endphp
                                    <a href="{{ route('customer.info') }}"
                                        class="{{ $route == 'customer.info' ? 'active' : '' }}">Customer
                                        Info</a>
                                    <a href="{{ route('customer.order_list') }}"
                                        class="@if ($route == 'customer.order_list') active
                                        @elseif ($route == 'customer.order_details')
                                        active @endif
                                        ">My
                                        Orders</a>
                                   
                                    <a href="{{ route('customer.password_change') }}"
                                        class="{{ $route == 'customer.password_change' ? 'active' : '' }}">Change
                                        Password</a>
                                    <a href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->
                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show {{ $route == 'customer.info' ? 'active' : '' }}"
                                        role="tabpanel">
                                        <div class="myaccount-content">
                                            <div class="account-details-form ms-3 mt-0">
                                                <h3>Personal Details</h3>
                                                <div class=" mb-2">
                                                    <img src="{{ @$editData ? asset('uploads/cat-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                                        alt="" id="showImage"
                                                        style="width: 100px; height:100px; border:1px solid #000">
                                                </div>
                                                <div class="row">


                                                    <div class="col-lg-4 ">
                                                        <label class="fw-normal fs-6 form-label">Profile Image</label>
                                                        <input type="file" name="image" class="form-control-file"
                                                            id="imageInfo" onchange="showPreview(event);">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="fw-normal fs-6 form-label">User Name: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="name" value="{{ @Auth::user()->name }}"
                                                            placeholder="User Name" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row mt-3">

                                                    <div class="col-lg-5">
                                                        <label class="fw-normal fs-6 form-label">Email: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="email" value="{{ $user->email }}"
                                                            placeholder="name@example.com" class="form-control">
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <label class="fw-normal fs-6 form-label">Mobile Number: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="mobileNumber" value="{{ $user->mobile_number }}"
                                                            placeholder="Mobile number" class="form-control">

                                                    </div>
                                                </div>
                                                <div class="row mt-4">
                                                    <div class="col-lg-4">
                                                        <label class="fw-normal fs-6 form-label">Gender: </label>
                                                        <div class="ms-2 mb-1">
                                                            <input class="form-check-input" name="gender" type="radio"
                                                                value="Male">
                                                            <label> Male</label>
                                                        </div>
                                                        <div class="ms-2">
                                                            <input class="form-check-input" name="gender" type="radio"
                                                                value="Female">
                                                            <label> Female</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="fw-normal fs-6 form-label">Date Of Birth: </label>
                                                        <input type="date" class="form-control">

                                                    </div>
                                                </div>


                                                <h3 class="mt-5">Address</h3>
                                                <div class="row">

                                                    <div class="col-lg-5">
                                                        <label class="fw-normal fs-6 form-label"> Street Addres: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="address" value="{{ $user->street_address }}"
                                                            class="form-control">
                                                    </div>

                                                </div>
                                                <div class="row mt-3">

                                                    <div class="col-lg-4">
                                                        <label class="fw-normal fs-6 form-label">District: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="district" value="{{ $user->district }}"
                                                            class="form-control">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <label class="fw-normal fs-6 form-label">Police Station: <span
                                                                class="text-danger">*</span></label>
                                                        <input type="policeStation" value="{{ $user->police_station }}"
                                                            class="form-control">

                                                    </div>
                                                </div>
                                                <div class="single-input-item btn-hover mt-4">
                                                    <button class="check-btn sqr-btn">Save Changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show @if ($route == "customer.order_list") active @elseif($route=="customer.order_details") active @endif"
                                        role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Orders</h3>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th></th>
                                                            <th>Sl</th>
                                                            <th>Order no</th>
                                                            <th>Payment</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td><input type="radio"
                                                                        {{ request()->is("customer/order_list/order_details/$order->id") ? 'checked' : '' }}>
                                                                </td>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $order->order_no }}</td>
                                                                <td>{{ $order->payment->payment_method }}</td>
                                                                <td>{{ $order->order_total }} Tk</td>
                                                                <td>
                                                                    @if ($order->status == 1)
                                                                        <span class="badge bg-success">Approved</span>
                                                                    @elseif ($order->status == 0)
                                                                        <span class="badge bg-danger">Pending</span>
                                                                    @endif
                                                                </td>
                                                                <td><a href="{{ route('customer.order_details',$order->id) }} "
                                                                        class="badge bg-success "><i
                                                                            class="fa fa-info-circle"
                                                                            aria-hidden="true"></i> Details</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        @if ($route=="customer.order_details")
                                        
                                        <div class="myaccount-content">
                                            <h3>Order Details</h3>
                                            <div class="account-details-form">
                                                <div class="row">
                                                    @foreach ($orderDetails as $details)
                                                        <div class="col-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    {{ $details->product->name }}
                                                                </div>
                                                                <div class="card-body">
                                                                    <table>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="width: 10rem;">Color: </td>
                                                                                <td>{{ @$details->color->name }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Size: </td>
                                                                                <td>{{ @$details->size->name }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Quantity: </td>
                                                                                <td>{{ $details->quantity }} </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Price: </td>
                                                                                <td>{{ $details->product->seller_price }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    @endforeach
                                                </div>

                                                <a href="{{ route('customer.order_list') }}"
                                                    class="btn btn-sm btn-success mt-4">Oder List</a>
                                            </div>
                                        </div>
                                        
                                    @endif
                                    </div>
                                    <!-- Single Tab Content End -->
                                  

                                    <!-- Single Tab Content End -->
                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade show {{ $route == 'customer.password_change' ? 'active' : '' }}"
                                        role="tabpanel">
                                        <div class="myaccount-content">
                                            <h3>Change Password</h3>
                                            @error('password_confirmation')
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    {{ $message }}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @enderror
                                            @if (Session::has('message'))
                                                <span class="text-danger">{{ Session::get('message') }}</span>
                                            @endif
                                            <div class="account-details-form">
                                                <form action="{{ route('customer.passwordUpdate') }}" method="POST">
                                                    @csrf
                                                    <div class="single-input-item col-lg-4">
                                                        <label for="new-pwd" class="required">Current Password</label>
                                                        <input type="password" name="current_password" id="new-pwd" />
                                                    </div>
                                                    <div class="single-input-item col-lg-4">
                                                        <label for="new-pwd" class="required">New Password</label>
                                                        <input type="password" name="password" id="new-pwd" />
                                                    </div>
                                                    <div class="single-input-item col-lg-4">
                                                        <label for="new-pwd" class="required">Confirm Password</label>
                                                        <input type="password" name="password_confirmation"
                                                            id="new-pwd" />
                                                    </div>
                                                    <div class="single-input-item btn-hover">
                                                        <button type="submit" class="check-btn sqr-btn">Save
                                                            Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
    <!-- my account wrapper end -->
@endsection --}}
@section('body')
<main class="main">
    <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
        <div class="container">
            <h1 class="page-title">My Account<span>Shop</span></h1>
        </div><!-- End .container -->
    </div><!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Shop</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            @php
                                        $route = Route::current()->getName();
                                    @endphp
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.info') }}"
                                class="{{ $route == 'customer.info' ? 'active' : '' }}">Customer
                                Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.order_list') }}"
                                class="@if ($route == 'customer.order_list') active
                                @elseif ($route == 'customer.order_details')
                                active @endif
                                ">My
                                Orders</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customer.password_change') }}"
                                        class="{{ $route == 'customer.password_change' ? 'active' : '' }}">Change
                                        Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                            </li>
                           
                        </ul>
                    </aside><!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="tab-pane fade show  {{ $route == 'customer.info' ? 'active' : '' }}" id="tab-dashboard" role="tabpanel" aria-labelledby="tab-dashboard-link">
                                <h3>Personal Details</h3>
                                <div class=" mb-2">
                                    <img src="{{ @$editData ? asset('uploads/cat-image/' . $editData->image) : asset('admin-assets/img/no-image.png') }}"
                                        alt="" id="showImage"
                                        style="width: 100px; height:100px; border:1px solid #000">
                                </div>
                                <div class="row">


                                    <div class="col-lg-4 ">
                                        <label class="fw-normal fs-6 form-label">Profile Image</label>
                                        <input type="file" name="image" class="form-control-file"
                                            id="imageInfo" onchange="showPreview(event);">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="fw-normal fs-6 form-label">User Name: <span
                                                class="text-danger">*</span></label>
                                        <input type="name" value="{{ @Auth::user()->name }}"
                                            placeholder="User Name" class="form-control">

                                    </div>
                                </div>
                                <div class="row mt-3">

                                    <div class="col-lg-5">
                                        <label class="fw-normal fs-6 form-label">Email: <span
                                                class="text-danger">*</span></label>
                                        <input type="email" value="{{ $user->email }}"
                                            placeholder="name@example.com" class="form-control">
                                    </div>
                                    <div class="col-lg-3">
                                        <label class="fw-normal fs-6 form-label">Mobile Number: <span
                                                class="text-danger">*</span></label>
                                        <input type="mobileNumber" value="{{ $user->mobile_number }}"
                                            placeholder="Mobile number" class="form-control">

                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <label class="fw-normal fs-6 form-label">Gender: </label>
                                        <div class="ml-5 mb-1">
                                            <input class="form-check-input mt-1" name="gender" type="radio"
                                                value="Male">
                                            <label><span class="ml-3"> Male</span></label>
                                        </div>
                                        <div class="ml-5">
                                            <input class="form-check-input mt-1" name="gender" type="radio"
                                                value="Female">
                                            <label> <span class="ml-3"> Female</span></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <label class="fw-normal fs-6 form-label">Date Of Birth: </label>
                                        <input type="date" class="form-control">

                                    </div>
                                </div>


                                <h3 class="mt-5">Address</h3>
                                <div class="row">

                                    <div class="col-lg-5">
                                        <label class="fw-normal fs-6 form-label"> Street Addres: <span
                                                class="text-danger">*</span></label>
                                        <input type="address" value="{{ $user->street_address }}"
                                            class="form-control">
                                    </div>

                                </div>
                                <div class="row mt-3">

                                    <div class="col-lg-4">
                                        <label class="fw-normal fs-6 form-label">District: <span
                                                class="text-danger">*</span></label>
                                        <input type="district" value="{{ $user->district }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="fw-normal fs-6 form-label">Police Station: <span
                                                class="text-danger">*</span></label>
                                        <input type="policeStation" value="{{ $user->police_station }}"
                                            class="form-control">

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary-2 mt-4">
                                    <span>SAVE CHANGES</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade show @if ($route == "customer.order_list") active @elseif($route=="customer.order_details") active @endif"" id="tab-orders" role="tabpanel" aria-labelledby="tab-orders-link">
                                <h3>Orders</h3>
                                            
                                                <table class="table ">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th></th>
                                                            <th>Sl</th>
                                                            <th>Order no</th>
                                                            <th>Payment</th>
                                                            <th>Total</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td><input type="radio"
                                                                        {{ request()->is("customer/order_list/order_details/$order->id") ? 'checked' : '' }}>
                                                                </td>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $order->order_no }}</td>
                                                                <td>{{ $order->payment->payment_method }}</td>
                                                                <td>{{ $order->order_total }} Tk</td>
                                                                <td>
                                                                    @if ($order->status == 1)
                                                                        <span class="badge bg-success">Approved</span>
                                                                    @elseif ($order->status == 0)
                                                                        <span class="badge bg-danger">Pending</span>
                                                                    @endif
                                                                </td>
                                                                <td><a href="{{ route('customer.order_details',$order->id) }} "
                                                                        class="badge bg-success "><i
                                                                            class="fa fa-info-circle"
                                                                            aria-hidden="true"></i> Details</a>
                                                                </td>
                                                            </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade show {{ $route == 'customer.password_change' ? 'active' : '' }}" id="tab-downloads" role="tabpanel" aria-labelledby="tab-downloads-link">
                                
                                <h3>Change Password</h3>
                                @error('password_confirmation')
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                        {{ $message }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @enderror
                                @if (Session::has('message'))
                                    <span class="text-danger">{{ Session::get('message') }}</span>
                                @endif
                                
                                    <form action="{{ route('customer.passwordUpdate') }}" method="POST">
                                        @csrf
                                        <div class=" col-lg-4">
                                            <label >Current Password</label>
                                            <input class="form-control" type="password" name="current_password" />
                                        </div>
                                        <div class=" col-lg-4">
                                            <label >New Password</label>
                                            <input class="form-control" type="password" name="password"  />
                                        </div>
                                        <div class=" col-lg-4">
                                            <label  >Confirm Password</label>
                                            <input class="form-control" type="password" name="password_confirmation" />
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary-2 mt-2 ml-2">
                                            <span>SAVE CHANGES</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>
                                    </form>
                                
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-address" role="tabpanel" aria-labelledby="tab-address-link">
                                <p>The following addresses will be used on the checkout page by default.</p>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Billing Address</h3><!-- End .card-title -->

                                                <p>User Name<br>
                                                User Company<br>
                                                John str<br>
                                                New York, NY 10001<br>
                                                1-234-987-6543<br>
                                                yourmail@mail.com<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a></p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->

                                    <div class="col-lg-6">
                                        <div class="card card-dashboard">
                                            <div class="card-body">
                                                <h3 class="card-title">Shipping Address</h3><!-- End .card-title -->

                                                <p>You have not set up this type of address yet.<br>
                                                <a href="#">Edit <i class="icon-edit"></i></a></p>
                                            </div><!-- End .card-body -->
                                        </div><!-- End .card-dashboard -->
                                    </div><!-- End .col-lg-6 -->
                                </div><!-- End .row -->
                            </div><!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel" aria-labelledby="tab-account-link">
                                <form action="#">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>First Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Last Name *</label>
                                            <input type="text" class="form-control" required>
                                        </div><!-- End .col-sm-6 -->
                                    </div><!-- End .row -->

                                    <label>Display Name *</label>
                                    <input type="text" class="form-control" required>
                                    <small class="form-text">This will be how your name will be displayed in the account section and in reviews</small>

                                    <label>Email address *</label>
                                    <input type="email" class="form-control" required>

                                    <label>Current password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>New password (leave blank to leave unchanged)</label>
                                    <input type="password" class="form-control">

                                    <label>Confirm new password</label>
                                    <input type="password" class="form-control mb-2">

                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SAVE CHANGES</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </form>
                            </div><!-- .End .tab-pane -->
                        </div>
                    </div><!-- End .col-lg-9 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->
</main><!-- End .main -->
@endsection
