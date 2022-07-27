<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.includes.meta')

 <title>@yield('title')</title>
    

    <!-- vendor css -->
    @include('admin.includes.css')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('admin.includes.left-slider')
    <!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    @include('admin.includes.header')
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    @include('admin.includes.right-panel')
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
@yield('breadcrumb')
      <div class="sl-pagebody">
    @yield('body')
  </div>
  @include('admin.includes.footer')
    </div>
    <!-- ########## END: MAIN PANEL ########## -->

   @include('admin.includes.script')
  </body>
</html>
