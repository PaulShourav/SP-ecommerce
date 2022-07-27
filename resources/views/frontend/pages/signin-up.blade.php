@extends('frontend.master')
@section('title', 'SignIn')
@section('body')
    <!-- Sign in / Register Modal -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                <li class="breadcrumb-item"><a href="">SignIn</a></li>


            </ol>
        </div><!-- End .container -->
    </nav><!-- End .breadcrumb-nav -->


    <div class="form-box">
        <div class="form-tab">
            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('signup') ? '' : 'active' }}" id="signin-tab" data-toggle="tab"
                        href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('signup') ? 'active' : '' }}" id="register-tab" data-toggle="tab"
                        href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                </li>
            </ul>
            <div class="tab-content" id="tab-content-5">
                <div class="tab-pane fade {{ request()->routeIs('signup') ? '' : 'show active' }}" id="signin"
                    role="tabpanel" aria-labelledby="signin-tab">
                    @if ($errors->any())
                    <div>
                        <p class="text-danger" style="font-size: 15px">'Whoops! Something went wrong.</p>
                    </div>
                    <ul class="mt-3 list-disc list-inside text-sm text-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label>Email address: <span class="text-danger">*</span> </label>
                            <input size="200px" class="form-control" id="email" type="email" name="email"
                                value="{{ old('email') }}" required>
                        </div><!-- End .form-group -->

                        <div class="form-group">
                            <label>Password: <span class="text-danger">*</span> </label>
                            <input type="password" class="form-control" id="password" name="password" required
                                autocomplete="current-password">
                        </div><!-- End .form-group -->

                        <div class="form-footer">
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>LOG IN</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>

                            {{-- <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signin-remember">
                                            <label class="custom-control-label" for="signin-remember">Remember Me</label>
                                        </div><!-- End .custom-checkbox --> --}}

                            <a href="#" class="forgot-link">Forgot Your Password?</a>
                        </div><!-- End .form-footer -->
                    </form>
                    {{-- <div class="form-choice">
                                    <p class="text-center">or sign in with</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-g">
                                                <i class="icon-google"></i>
                                                Login With Google
                                            </a>
                                        </div><!-- End .col-6 -->
                                        <div class="col-sm-6">
                                            <a href="#" class="btn btn-login btn-f">
                                                <i class="icon-facebook-f"></i>
                                                Login With Facebook
                                            </a>
                                        </div><!-- End .col-6 -->
                                    </div><!-- End .row -->
                                </div><!-- End .form-choice --> --}}
                </div><!-- .End .tab-pane -->
                <div class="tab-pane fade {{ request()->routeIs('signup') ? 'show active' : '' }}" id="register"
                    role="tabpanel" aria-labelledby="register-tab">
                   
                    <form action="{{ route('singup_store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label for="name">User Name: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="name" name="name">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="form-group">
                                    <label for="mobile-number">Mobile Number: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" name="mobile_number">
                                    @error('mobile_number')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="register-email">Your email address: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="register-email" name="email">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div><!-- End .form-group -->
                        <div class="form-group">
                            <label for="street-address">Street address: <span class="text-danger">*</span> </label>
                            <input type="text" class="form-control" name="street_address">
                            @error('street_address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="district">District: <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control" id="district" name="district">
                                    @error('district')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="police-station">Police station: <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="police-station"
                                        name="police_station">
                                    @error('police_station')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="register-password">Password: <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="register-password" name="password">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div><!-- End .form-group -->
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="register-password">Confirm Password: <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="register-password"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-footer">
                            <button type="submit" class="btn btn-outline-primary-2">
                                <span>SIGN UP</span>
                                <i class="icon-long-arrow-right"></i>
                            </button>

                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="register-policy">
                                <label class="custom-control-label" for="register-policy">I agree to the <a
                                        href="#">privacy policy</a> *</label>
                            </div><!-- End .custom-checkbox -->
                        </div><!-- End .form-footer -->
                    </form>
                    <div class="form-choice">
                        <p class="text-center">or sign in with</p>
                        <div class="row">
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-login btn-g">
                                    <i class="icon-google"></i>
                                    Login With Google
                                </a>
                            </div><!-- End .col-6 -->
                            <div class="col-sm-6">
                                <a href="#" class="btn btn-login  btn-f">
                                    <i class="icon-facebook-f"></i>
                                    Login With Facebook
                                </a>
                            </div><!-- End .col-6 -->
                        </div><!-- End .row -->
                    </div><!-- End .form-choice -->
                </div><!-- .End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .form-tab -->
    </div><!-- End .form-box -->

@endsection
