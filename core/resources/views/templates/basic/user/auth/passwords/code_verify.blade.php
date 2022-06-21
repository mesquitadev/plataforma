@extends($activeTemplate.'layouts.master')


@section('content')
    @include($activeTemplate.'layouts.breadcrumb')
    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">
                        <div class="common-form-style bg-one login-account account-wrapper text-center">
                            <h4 class="title">@lang('Verification Code')</h4>
                            <form class="create-account-form" method="post"
                                  action="{{ route('user.password.verify-code') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <div class="form-group my-3">
                                    <div id="phoneInput">
                                        <div class="field-wrapper">
                                            <div class=" phone">
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required >
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required >
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter"
                                                       pattern="[0-9]*" inputmode="numeric" maxlength="1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="{{ __('Submit') }}">
                                </div>
                                <div class="form-group">
                                    <div class="checkbox-wrapper d-flex flex-wrap align-items-center">
                                        <p class="mt-2">@lang('Please check including your Junk/Spam Folder. if not found, you can')
                                            <a class="text-danger"
                                               href="{{ route('user.password.request') }}">@lang('Try to send again')</a>
                                        </p>
                                    </div>
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

