
@extends('admin.master')
@section('title', 'Profile')
@section('breadcrumb')
    <nav class="breadcrumb sl-breadcrumb mt-0">
        <a class="breadcrumb-item" href="index.html">Starlight</a>
        <span class="breadcrumb-item active">
            password_change
        </span>
    </nav>
@endsection
@section('body')
    <div class="row justify-content-center">
        <div class="col-lg-6 ">
            <div class="card">
                <div class="card-header text-center">
                    <div class="image">
                        <img src="{{@Auth::user()->image==null?asset('admin-assets/img/usericon8.png'):asset('uploads/user-image/'.@Auth::user()->image)}}" 
                        style=" border:1px solid black;    
                        height:100px;
                        width:100px;
                        border-radius:50%;" alt="">
                    </div>
                    <h4 class="mt-3">{{@Auth::user()->name}}</h4>
                    @if (Session::has('message'))
                    <span class="text-danger">{{ Session::get('message') }}</span>
                    @endif
                </div>
                
                <div class="card-body">
                    
                    <form action="{{route('user.password_change.store')}}" method="POST">
                        @csrf
                    <div class="form-group">
                        <label class="form-control-label">Current Password: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="password"
                            name="current_password" placeholder="Enter Current password">
                        @error('current_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">New Password: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="password"
                            name="password" placeholder="Enter password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-control-label">Confirm Password: <span class="tx-danger">*</span></label>
                        <input class="form-control" type="password"
                            name="password_confirmation">
                        @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-layout-footer">
                        <button type="submit"
                            class="btn btn-primary mg-r-5">Update</button>

                    </div>
                </form>
                </div>
              </div>
        </div>
    </div>


@endsection


