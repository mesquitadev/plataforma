@extends($activeTemplate.'layouts.master')

@section('content')

    @php
        $sliders = getContent('slider.element');
    @endphp
    <section class="banner-slider">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <div class="swiper-slide">
                    <div class="banner-container bg-overlay bg_img" data-background="{{getImage('assets/images/frontend/slider/' . @$slider->data_values->background_image, '1920x850')}}">
                        <div class="container">
                            <div class="banner-content">
                                <h3 class="sub-title">{{__(@$slider->data_values->title)}}</h3>
                                <h1 class="title">{{__(@$slider->data_values->subtitle)}}</h1>
                                <div class="button-area">
                                    <p>{{__(@$slider->data_values->description)}}</p>
                                    <div class="button-group">
                                        <a href="{{__(@$slider->data_values->left_button_link)}}" class="custom-button active">{{__(@$slider->data_values->left_button)}}</a>
                                        <a href="{{__(@$slider->data_values->right_button_link)}}" class="custom-button">{{__(@$slider->data_values->right_button)}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="banner-prev"><i class="fas fa-angle-left"></i></div>
        <div class="banner-next"><i class="fas fa-angle-right"></i></div>
    </section>

    @if($sections->secs != null)
        @foreach(json_decode($sections->secs) as $sec)
            @include($activeTemplate.'sections.'.$sec)
        @endforeach
    @endif

@endsection




