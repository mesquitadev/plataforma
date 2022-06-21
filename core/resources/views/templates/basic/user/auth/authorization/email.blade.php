@extends($activeTemplate.'layouts.master')

@section('content')

    @include($activeTemplate.'layouts.breadcrumb')


    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">
                        <div class="common-form-style bg-one login-account account-wrapper">
                            <h5 class="title text-center">@lang('Please verify your email to get access')</h5>
                            <p class="text-center">@lang('Your Email:') <strong>{{auth()->user()->email}}</strong></p>
                            <form class="create-account-form" method="post" action="{{route('user.verify_email')}}">
                                @csrf
                                <div class="form-group">
                                    <div id="phoneInput">

                                        <div class="field-wrapper">
                                            <div class=" phone">
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="email_verified_code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                        <p class="mt-3">@lang('Please check including your Junk/Spam Folder. if not found, you can')
                                            <a class="text-danger"
                                               href="{{route('user.send_verify_code')}}?type=email">@lang('Resend code')</a>
                                        </p>
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
