@extends($activeTemplate.'layouts.master')

@section('content')

    @include($activeTemplate.'layouts.breadcrumb')

    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="account-wrapper">
                <div class="signup-area account-area">
                    <div class="row m-0 flex-wrap-reverse">
                        <div class="col-lg-6 p-0">
                            <div class="change-catagory-area bg_img"
                                 data-background="{{getImage('assets/images/frontend/sign_in/' . @$content->data_values->background_image, '650x600')}}">
                                <h4 class="title">{{__(@$content->data_values->register_section_title)}}</h4>
                                <p>{{__(@$content->data_values->register_section_short_details)}}</p>
                                <a href="{{route('user.register')}}"
                                   class="custom-button account-control-button">@lang('Sign Up')</a>
                            </div>
                        </div>
                        <div class="col-lg-6 p-0">
                            <div class="common-form-style bg-one login-account">
                                <h4 class="title">{{__(@$content->data_values->title)}}</h4>
                                <p class="mb-sm-4 mb-3">{{__(@$content->data_values->short_details)}}</p>
                                <form class="create-account-form" method="post" action="{{route('user.login')}}"
                                      onsubmit="return submitUserForm();">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" value="{{old('username')}}"
                                               placeholder="@lang('Username')" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="myInputThree" name="password"
                                               placeholder="@lang('Password')" required>
                                        <a href="javascript:void(0)" class="show-pass show-pass-three"><i class="fas fa-eye"></i></a>
                                    </div>

                                    @if(reCaptcha())
                                        <div class="form-group my-3">
                                            @php echo reCaptcha(); @endphp
                                        </div>
                                    @endif

                                    @include($activeTemplate.'partials.custom-captcha')

                                    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                                        <ul class="lost-pass m-0 pt-3">
                                            <li class="w-100">
                                                <a href="{{route('user.password.request')}}">@lang('Forget Password?')</a>
                                            </li>
                                        </ul>
                                        <input type="submit" value="@lang('Login Account')">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection


@push('script')
    <script>
        function submitUserForm() {
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="text-danger">@lang("Captcha field is required.")</span>';
                return false;
            }
            return true;
        }
        function verifyCaptcha() {
            document.getElementById('g-recaptcha-error').innerHTML = '';
        }
    </script>
@endpush
