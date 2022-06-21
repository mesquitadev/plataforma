@extends($activeTemplate.'layouts.master')

@section('content')

    @include($activeTemplate.'layouts.breadcrumb')

    <section class="account-section padding-bottom padding-top">
        <div class="container">
            <div class="signup-area account-area">
                <div class="row m-0 justify-content-center">
                    <div class="col-lg-6 p-0">
                        <div class="common-form-style bg-one login-account account-wrapper">
                            <h4 class="title">{{ __('Reset Password') }}</h4>
                            <form class="create-account-form" method="post" action="{{ route('user.password.email') }}">
                                @csrf

                                <div class="form-group">
                                    <select class="form-control" name="type">
                                        <option value="email">@lang('E-Mail Address')</option>
                                        <option value="username">@lang('Username')</option>
                                    </select>
                                </div>

                                <div class="form-group">

                                        <input type="text" class=" @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autofocus="off" placeholder="@lang('Type Here...')">

                                        @error('value')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>


                                <div class="form-group">
                                    <input type="submit" value="@lang('Send Password Reset Code')">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
<script type="text/javascript">
    $('select[name=type]').change(function(){
        $('.my_value').text($('select[name=type] :selected').text());
    }).change();
</script>
@endpush
