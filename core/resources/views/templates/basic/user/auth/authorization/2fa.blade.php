@extends($activeTemplate .'layouts.master')
@section('content')
    @include($activeTemplate.'layouts.breadcrumb')

    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">
                        <div class="common-form-style bg-one login-account account-wrapper">
                            <h4 class="title text-center">@lang('2FA Verification')</h4>
                            <p class="text-center">@lang('Current Time'): {{\Carbon\Carbon::now()}}</p>
                            <form class="create-account-form" method="post" action="{{route('user.go2fa.verify')}}">
                                @csrf
                                <div class="form-group my-3">
                                    <div id="phoneInput">
                                        <div class="field-wrapper">
                                            <div class=" phone">
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                                <input type="text" name="code[]" class="letter" pattern="[0-9]*"
                                                       inputmode="numeric" maxlength="1" required>
                                            </div>
                                        </div>
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
