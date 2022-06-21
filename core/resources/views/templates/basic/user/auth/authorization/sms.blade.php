@extends($activeTemplate .'layouts.master')

@section('content')
    @include($activeTemplate.'layouts.breadcrumb')

    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">

                        <div class="common-form-style bg-one login-account account-wrapper">
                            <h5 class="text-center mb-3">@lang('Please verify your Mobile to get access')</h5>
                            <p class="text-center">@lang('Your Mobile Number:')
                                <strong>{{auth()->user()->mobile}}</strong></p>
                            <form class="create-account-form" method="post" action="{{route('user.verify_sms')}}">
                                @csrf
                                <div class="form-group my-3">
                                    <div id="phoneInput">
                                        <div class="field-wrapper">
                                            <div class=" phone">
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="sms_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                        <p class="mt-3">@lang('If not found, you can')
                                            <a class="text-danger" href="{{route('user.send_verify_code')}}?type=phone">
                                                @lang('Resend code')</a></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn-block w-100" value="@lang('Submit')">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@include('partials.phoneInputScript')
