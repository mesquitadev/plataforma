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

<header>


    <div class="header-top">
        <div class="container">
            <div class="header-top-area">


                <div class="header-top-item">
                    <a href="Mailto:{{@$contact->data_values->email_address}}"><i class="fa fa-envelope"></i>{{@$contact->data_values->email_address}}</a>
                </div>
                <div class="header-top-item">
                    <a href="tel:{{@$contact->data_values->contact_number}}"><i class="fa fa-mobile-alt"></i>{{@$contact->data_values->contact_number}}</a>
                </div>

                <div class="header-top-item ml-auto d-none d-sm-block">
                    <select class="select-bar langSel">
                        @foreach($language as $item)
                            <option value="{{$item->code}}"
                                    @if(session('lang') == $item->code) selected @endif>{{ __($item->name) }}</option>
                        @endforeach
                    </select>
                </div>



            </div>
        </div>
    </div>




    <div class="header-bottom">
        <div class="container">
            <div class="header-area">
                <div class="logo">
                    <a href="{{url('/')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}"
                                                alt="logo"></a>
                </div>
                <ul class="menu">
                    <li><a href="{{url('/')}}">@lang('Home')</a></li>
                    @foreach($pages as $k => $data)
                        <li><a href="{{route('pages',[$data->slug])}}">{{trans($data->name)}}</a></li>
                    @endforeach
                    <li><a href="{{route('blog')}}">@lang('Blog')</a></li>
                    <li><a href="{{route('contact')}}">@lang('Contact')</a></li>
                    @auth
                        <li><a href="javascript:void(0)">{{auth()->user()->username}}</a>
                            <ul class="submenu">
                                <li><a href="{{route('user.home')}}">@lang('Dashboard')</a></li>
                                <li><a href="{{route('user.logout')}}">@lang('Logout')</a></li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="javascript:void(0)">@lang('Account')</a>
                            <ul class="submenu">
                                <li><a href="{{route('user.login')}}">@lang('Sign In')</a>
                                </li>
                                <li><a href="{{route('user.register')}}">@lang('Sign Up')</a></li>
                            </ul>
                        </li>
                    @endauth
                </ul>

                <select class="select-bar d-sm-none ml-auto mr-3 langSel">
                    @foreach($language as $item)
                        <option value="{{$item->code}}"
                                @if(session('lang') == $item->code) selected @endif>{{ __($item->name) }}</option>
                    @endforeach
                </select>

                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ============Header Section Ends Here============ -->
@yield('content')
<!-- ============Footer Section Starts Here============ -->

<footer>
    <div class="footer-top">
        <div class="container">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{getImage(imagePath()['logoIcon']['path'] .'/logo.png')}}" alt="logo"></a>
            </div>
            <p>{{__(@$footer->data_values->website_footer)}}</p>
            <ul class="social-icons">
                @foreach($socials as $social)
                    <li><a href="{{@$social->data_values->url}}" target="_blank"
                           title="{{@$social->data_values->title}}">@php echo @$social->data_values->social_icon; @endphp</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>{{__(@$footer->data_values->copyright)}}</p>
    </div>
</footer>
<!-- ============Footer Section Ends Here============ -->
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
