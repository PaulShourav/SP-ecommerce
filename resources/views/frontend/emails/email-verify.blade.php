@extends('frontend.master')
@section('title', 'Email verify')
@section('body')
 <!-- Sign in / Register Modal -->
 <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
            
            <li class="breadcrumb-item"><a href="">SignIn</a></li>
         
            
        </ol>
    </div><!-- End .container -->
</nav><!-- End .breadcrumb-nav -->
              

                <div class="form-box">
                    <div class="form-tab">
                        <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" >Email Verify</a>
                            </li>
                            
                        </ul> 
                        <div class="tab-content" id="tab-content-5">
                           @if (Session::has('message'))
                               <span class="text-danger">{{Session::get('message')}}</span>
                           @endif
                                <form action="{{route('email_verify_store')}}" method="POST" class="mt-4" >
                                   @csrf
                                    <div class="form-group">
                                        <label for="singin-email">Email: <span class="text-danger">*</span></label>
                                        <input size="200px" type="text" class="form-control"  name="email" required>
                                        @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div><!-- End .form-group -->

                                    <div class="form-group">
                                        <label >Verification Code: <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control"  name="code" required>
                                        @error('code')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div><!-- End .form-group -->

                                    <div class="form-footer">
                                        <button type="submit" class="btn btn-outline-primary-2">
                                            <span>Verify</span>
                                            <i class="icon-long-arrow-right"></i>
                                        </button>

                                    </div><!-- End .form-footer -->
                                </form>
                          
                            
                        </div><!-- End .tab-content -->
                    </div><!-- End .form-tab -->
                </div><!-- End .form-box -->
    
@endsection

