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
                                   class="custom-button account-control-button">@lang('Entrar na Conta')</a>
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
                                                       placeholder="@lang('Digite o Usuário do Patrocinador')*" required>
                                                <div id="ref"></div>
                                                <span id="referral"></span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6 ">
                                            <div class="form-group ">
                                                <input type="text" name="referral" class="referral"
                                                       value="{{$ref_user->username}}"
                                                       placeholder="@lang('Digite o código do patrocinador')*" required
                                                       readonly>
                                            </div>
                                        </div>

                                    @endif

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="firstname" value="{{old('firstname')}}"
                                                   autocomplete="off" placeholder="@lang('Nome')*"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="lastname" value="{{old('lastname')}}"
                                                   placeholder="@lang('Sobrenome')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="email" name="email" value="{{old('email')}}"
                                                   placeholder="@lang('Email')*" required>
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
                                                   placeholder="@lang('Telefone')" required>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="text" name="country" placeholder="@lang('País')" readonly/>
                                        </div>
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="city" value="{{old('city')}}"
                                                   placeholder="@lang('Cidade')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="state" value="{{old('state')}}"
                                                   placeholder="@lang('Estado')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group ">
                                            <input type="text" name="zip" value="{{old('zip')}}"
                                                   placeholder="@lang('CEP')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <input type="text" name="username" value="{{old('username')}}"
                                                   placeholder="@lang('Digite seu Usuário')*" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="password" name="password" id="myInputTwo"
                                                   placeholder="@lang('Senha')*">
                                        </div>

                                        @if($general->secure_password)
                                            <p class="text-danger my-1 capital">@lang('Uma letra maiúscula é obrigatória')</p>
                                            <p class="text-danger my-1 number">@lang('Um número é obrigatório')</p>
                                            <p class="text-danger my-1 special">@lang('Um caractere especial é obrigatório')</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <input type="password" name="password_confirmation" id="myInputTwo"
                                                   placeholder="@lang('Confirmar Senha')*" required>
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
                                        <input type="submit" value="Criar sua Conta">
                                    </div>
                                </form>
                                <p class="terms-and-conditions"> <a
                                        href="{{route('terms')}}"> @lang('Termos & Condições')</a></p>
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
                        $("#ref").html(data.msg);
                    }
                });
            });

            @if(@$country_code)
            $(`option[data-code={{ $country_code }}]`).attr('selected', '');
            @endif
            $('select[name=country_code]').change(function () {
                $('input[name=country]').val($('select[name=country_code] :selected').data('country'));
            }).change();

            function submitUserForm() {
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:red;">@lang("O Captcha é obrigatório!")</span>';
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


        })(jQuery);


    </script>



@endpush


