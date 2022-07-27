<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.includes.meta')

    <title>SP-Admin Login</title>

    <!-- vendor css -->
    <!-- Starlight CSS -->
    @include('admin.includes.css')
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">starlight <span class="tx-info tx-normal">admin</span></div>
        <div class="tx-center mg-b-60">Professional Admin Template Design</div>
  {{-- @if (session('status'))
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{session('status')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  @endif --}}
        
     <!-- Session Status -->
     {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}
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
        @if(Session::has('meassage'))
        <span class="text-danger">{{Session::get('message')}}</span>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
        <div class="form-group">
          <input class="form-control" id="email" type="email" name="email" value="{{old('email')}}" required autofocus>
        </div><!-- form-group -->
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password" >
          <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">Sign In</button>
        </form>
        <div class="mg-t-60 tx-center">Not yet a member? <a href="page-signup.html" class="tx-info">Sign Up</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    @include('admin.includes.script')

  </body>
</html>