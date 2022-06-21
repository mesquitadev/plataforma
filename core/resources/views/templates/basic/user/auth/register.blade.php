@extends($activeTemplate.'layouts.master')

@section('content')

    @include($activeTemplate.'layouts.breadcrumb')


    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="account-wrapper">
                <div class="login-area account-area">
                    <div class="row m-0">
                        <div class="col-lg-4 p-0">
                            <div class="change-catagory-area bg_img"
                                 data-background="{{getImage('assets/images/frontend/sign_up/' . @$content->data_values->background_image, '450x970')}}">
                                <h4 class="title">{{__(@$content->data_values->login_section_title)}}</h4>
                                <p>{{__(@$content->data_values->login_section_short_details)}}</p>
                                <a href="{{route('user.login')}}"
                                   class="custom-button account-control-button">@lang('Login Account')</a>
                            </div>
                        </div>
                        <div class="col-lg-8 p-0">
                            <div class="common-form-style bg-one create-account">
                                <h4 class="title">{{__(@$content->data_values->title)}}</h4>
                                <p class="mb-sm-4 mb-3">{{__(@$content->data_values->short_details)}}</p>
                                <form class="create-account-form form-row" method="post"
                                      action="{{route('user.register')}}" onsubmit="return submitUserForm();">
                                    @csrf

                                    @if ($ref_user == null)

                                        <div class="col-md-6 ">
                                            <div class="form-group ">
                                                <input type="text" name="referral" class="referral"
                                                       value="{{old('referral')}}" id="ref_name"
                                                       placeholder="@lang('Enter referral username')*" required>
                                                <div id="ref"></div>
                                                <span id="referral"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group ">
                                                <select name="position" class="position" id="position" required
                                                        disabled>
                                                    <option value="">@lang('Select position')*</option>
                                                    @foreach(mlmPositions() as $k=> $v)
                                                        <option value="{{$k}}">@lang($v)</option>
                                                    @endforeach
                                                </select>
                                                <span id="position-test"><span
                                                        class="text-danger">@lang('Please enter referral username first')</span></span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6 ">
                                            <div class="form-group ">
                                                <input type="text" name="referral" class="referral"
                                                       value="{{$ref_user->username}}"
                                                       placeholder="@lang('Enter referral username')*" required
                                                       readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <select class="position" id="position" required disabled>
                                                    <option value="">@lang('Select position')*</option>
                                                    @foreach(mlmPositions() as $k=> $v)
                                                        <option @if($position == $k) selected
                                                                @endif value="{{$k}}">@lang($v)</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" name="position" value="{{$position}}">
                                                @php echo $joining; @endphp
                                            </div>
                                        </div>
                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="firstname" value="{{old('firstname')}}"
                                                   autocomplete="off" placeholder="@lang('Enter your first name')*"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="lastname" value="{{old('lastname')}}"
                                                   placeholder="@lang('Enter your last name')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="email" name="email" value="{{old('email')}}"
                                                   placeholder="@lang('Enter your email')*" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <div class="input-group mb-3 input-group-custom">
                                            <div class="input-group-prepend">
                                                <select name="country_code" class="input-group-text">
                                                    @include('partials.country_code')
                                                </select>
                                            </div>
                                            <input type="text" class="form-control" name="mobile"
                                                   placeholder="@lang('Your Phone Number')" required>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="country" placeholder="@lang('Country')" readonly/>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="city" value="{{old('city')}}"
                                                   placeholder="@lang('Enter your city')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="state" value="{{old('state')}}"
                                                   placeholder="@lang('Enter your state')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="zip" value="{{old('zip')}}"
                                                   placeholder="@lang('Enter your zip')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" name="username" value="{{old('username')}}"
                                                   placeholder="@lang('Enter your username')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="password" name="password" id="myInputTwo"
                                                   placeholder="@lang('Password')*">
                                        </div>

                                        @if($general->secure_password)
                                            <p class="text-danger my-1 capital">@lang('At least 1 capital letter is required')</p>
                                            <p class="text-danger my-1 number">@lang('At least 1 number is required')</p>
                                            <p class="text-danger my-1 special">@lang('At least 1 special character is required')</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="password" name="password_confirmation" id="myInputTwo"
                                                   placeholder="@lang('Confirm password')*" required>
                                        </div>
                                    </div>

                                    @if(reCaptcha())
                                        <div class="col-md-6 ">
                                            <div class="form-group my-3">
                                                @php echo reCaptcha(); @endphp
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group col-md-12">
                                        @include($activeTemplate.'partials.custom-captcha')
                                    </div>


                                    <div class="form-group col-md-12">
                                        <input type="submit" value="Create an Account">
                                    </div>
                                </form>
                                <p class="terms-and-conditions">@lang('First Read Our All') <a
                                        href="{{route('terms')}}"> @lang('Terms & Conditions')</a></p>
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

        (function ($) {
            "use strict";
            var not_select_msg = $('#position-test').html();
            $(document).on('keyup', '#ref_name', function () {
                var ref_id = $('#ref_name').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('check.referral')}}",
                    data: {
                        'ref_id': ref_id,
                        '_token': token
                    },
                    success: function (data) {
                        if (data.success) {
                            $('select[name=position]').removeAttr('disabled');
                            $('#position-test').text('');
                        } else {
                            $('select[name=position]').attr('disabled', true);
                            $('#position-test').html(not_select_msg);
                        }
                        $("#ref").html(data.msg);
                    }
                });
            });
            $(document).on('change', '#position', function () {
                updateHand();
            });

            function updateHand() {
                var pos = $('#position').val();
                var referrer_id = $('#referrer_id').val();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type: "POST",
                    url: "{{route('get.user.position')}}",
                    data: {
                        'referrer': referrer_id,
                        'position': pos,
                        '_token': token
                    },
                    success: function (data) {
                        $("#position-test").html(data.msg);
                    }
                });
            }

            @if(@$country_code)
            $(`option[data-code={{ $country_code }}]`).attr('selected', '');
            @endif
            $('select[name=country_code]').change(function () {
                $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
            }).change();

            function submitUserForm() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("Captcha field is required.")</span>';
                    return false;
                }
                return true;
            }

            function verifyCaptcha() {
                document.getElementById('g-recaptcha-error').innerHTML = '';
            }

            @if($general->secure_password)
            $('input[name=password]').on('input', function () {
                var password = $(this).val();
                var capital = /[ABCDEFGHIJKLMNOPQRSTUVWXYZ]/;
                var capital = capital.test(password);
                if (!capital) {
                    $('.capital').removeClass('d-none');
                } else {
                    $('.capital').addClass('d-none');
                }
                var number = /[123456790]/;
                var number = number.test(password);
                if (!number) {
                    $('.number').removeClass('d-none');
                } else {
                    $('.number').addClass('d-none');
                }
                var special = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
                var special = special.test(password);
                if (!special) {
                    $('.special').removeClass('d-none');
                } else {
                    $('.special').addClass('d-none');
                }

            });
            @endif

            @if(old('position'))
            $(`select[name=position]`).val('{{ old('position') }}');
            @endif

        })(jQuery);


    </script>



@endpush


