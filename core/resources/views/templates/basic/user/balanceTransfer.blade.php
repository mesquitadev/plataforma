@extends($activeTemplate . 'user.layouts.app')

@section('panel')

    <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title font-weight-normal">@lang('Transferências')</h4>
                    </div>
                    <div class="col-md-12 text-center">
                        <div class="alert block-none alert-danger p-2" role="alert">
                            <strong>@lang('A taxa de transferência fixa é') {{getAmount($general->bal_trans_fixed_charge)}} {{__($general->cur_text)}} @lang('ou')  {{getAmount($general->bal_trans_per_charge)}}
                                % @lang(' do total do valor transferido.')</strong>
                            <p id="after-balance"></p>
                        </div>
                    </div>
                    <form class="contact-form"  method="POST" action="{{route('user.balance.transfer.post')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                      <label> <h5>  @lang('Usuário / Email Para Enviar Saldo')  <span class="text-danger">*</span> </h5></label>
                                    <input type="text" class="form-control form-control-lg" id="username" name="username"
                                           placeholder="@lang('usuário / email')" required autocomplete="off">
                                    <span id="position-test"></span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="InputMail">
                                        <h5>@lang('Valor')<span class="requred">*</span> </h5>
                                    </label>
                                    <input onkeyup="this.value = this.value.replace (/^\.|[^\d\.]/g, '')"  class="form-control form-control-lg" autocomplete="off" id="amount" name="amount" placeholder="@lang('Valor') {{__($general->cur_text)}}" required>
                                    <span id="balance-message"></span>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class=" btn btn-block btn--primary mr-2">@lang('Transferir')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
@push('script')

    <script>
        'use strict';
        (function($){
            $(document).on('keyup', '#username', function () {
                var username = $('#username').val();
                var token = "{{csrf_token()}}";
                if(username){
                    $.ajax({
                        type: "POST",
                        url: "{{route('user.search.user')}}",
                        data: {
                            'username': username,
                            '_token': token
                        },
                        success: function (data) {
                            if (data.success) {
                                $('#position-test').html('<div class="text--success mt-1">@lang("Usuário Encontrado")</div>');
                            } else {
                                $('#position-test').html('<div class="text--danger mt-2">@lang("Usuário não Encontrado")</div>');
                            }
                        }
                    });
                }else{
                    $('#position-test').html('');
                }
            });
            $(document).on('keyup', '#amount', function () {
                var amount = parseFloat($('#amount').val()) ;
                var balance = parseFloat("{{Auth::user()->balance+0}}");
                var fixed_charge = parseFloat("{{$general->bal_trans_fixed_charge+0}}");
                var percent_charge = parseFloat("{{$general->bal_trans_per_charge+0}}");
                var percent = (amount * percent_charge) / 100;
                var with_charge = amount+fixed_charge+percent;
                if(with_charge > balance)
                {
                    $('#after-balance').html('<p  class="text-danger">' + with_charge  + ' {{$general->cur_text}} ' + ' {{__('será subtraído do seu saldo')}}' + '</p>');
                    $('#balance-message').html('<small class="text-danger">Insufficient Balance!</small>');
                } else if (with_charge <= balance) {
                    $('#after-balance').html('<p class="text-danger">' + with_charge  + ' {{$general->cur_text}} ' + ' {{__('será subtraído do seu saldo')}}' + '</p>');
                    $('#balance-message').html('');
                }
            });
        })(jQuery)
    </script>

@endpush
