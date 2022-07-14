<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $general->sitename}} - {{__(@$page_title)}} </title>
    <link rel="shortcut icon" href="{{getImage(imagePath()['logoIcon']['path'] .'/favicon.png')}}" type="image/x-icon">
    @include('partials.seo')

    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/swiper.min.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/odometer.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/flaticon.css')}}">

    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/line-awesome.min.css')}}">

    @stack('style-lib')
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/main.css')}}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue . 'frontend/css/custom.css')}}">
    @stack('css')
    <link rel="stylesheet" href='{{ asset($activeTemplateTrue."frontend/css/color.php?color=$general->base_color")}}'>

    @stack('style')
</head>

<body>

@stack('facebook')

<div class="overlay"></div>
<a href="#0" class="scrollToTop"><i class="flaticon-arrow"></i></a>
<div class="overlayer" id="overlayer">
    <div class="loader">
        <div class="loader-inner"></div>
    </div>
</div>

@yield('content')

<script src="{{asset($activeTemplateTrue . 'frontend/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/modernizr-3.6.0.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/plugins.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/magnific-popup.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/swiper.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/wow.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/odometer.min.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/viewport.jquery.js')}}"></script>
<script src="{{asset($activeTemplateTrue . 'frontend/js/nice-select.js')}}"></script>
@stack('script-lib')

<script src="{{asset($activeTemplateTrue . 'frontend/js/main.js')}}"></script>

@stack('js')
@include('partials.notify')
@include('partials.plugins')

<script>
    $(document).on("change", ".langSel", function () {
        window.location.href = "{{url('/')}}/change/" + $(this).val();
    });
</script>
@stack('script')

</body>
</html>
