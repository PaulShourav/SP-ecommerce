 <!-- Plugins JS File -->
 <script src="{{asset('front-assets')}}/js/jquery.min.js"></script>
 <script src="{{asset('front-assets')}}/js/bootstrap.bundle.min.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.hoverIntent.min.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.waypoints.min.js"></script>
 <script src="{{asset('front-assets')}}/js/superfish.min.js"></script>
 <script src="{{asset('front-assets')}}/js/owl.carousel.min.js"></script>
 <script src="{{asset('front-assets')}}/js/bootstrap-input-spinner.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.elevateZoom.min.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.plugin.min.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.magnific-popup.min.js"></script>
 <script src="{{asset('front-assets')}}/js/jquery.countdown.min.js"></script>
 <!-- Main JS File -->
 <script src="{{asset('front-assets')}}/js/main.js"></script>
 <script src="{{asset('front-assets')}}/js/demos/demo-4.js"></script>
 @if (Session::has('success'))
    <script>
        $.notify("{{ Session::get('success') }}", {
            position: 'top center',
            className: 'success'
        })
    </script>
@endif
@stack('scripts')