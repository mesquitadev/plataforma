@extends($activeTemplate.'layouts.master')


@section('content')
    @include($activeTemplate.'layouts.breadcrumb')

    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">
                        <div class="common-form-style bg-one login-account account-wrapper">
                            <h4 class="title">@lang('Reset Password')</h4>
                            <form class="create-account-form" method="post" action="{{ route('user.password.update') }}">
                                @csrf
                                <input type="hidden" name="email" value="{{ $email }}">
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group my-3">
                                    <input type="Password" name="password"   placeholder="@lang('Password')">
                                </div>
                                <div class="form-group my-3">
                                    <input type="Password" name="password_confirmation"  placeholder="@lang('Confirm Password')">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="@lang('Change Password')">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
