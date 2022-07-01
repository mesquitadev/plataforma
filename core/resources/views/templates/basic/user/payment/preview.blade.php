@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="container">
        <div class="row  justify-content-center">
            <div class="col-md-8">

                <div class="card card-deposit text-center">
                    <div class="card-body card-body-deposit">
                        <ul class="list-group text-center">
                            <li class="list-group-item " >
                                <img class="max-w-h-100px" src="{{ $data->gateway_currency()->methodImage() }}" />
                            </li>
                            <p class="list-group-item">
                                @lang('Valor'):
                                <strong>{{getAmount($data->amount)}} </strong> {{$general->cur_text}}
                            </p>
                            <p class="list-group-item">
                                @lang('Taxa'):
                                <strong>{{getAmount($data->charge)}}</strong> {{$general->cur_text}}
                            </p>
                            <p class="list-group-item">
                                @lang('Pagável'): <strong> {{getAmount($data->amount + $data->charge)}}</strong> {{$general->cur_text}}
                            </p>
                            <p class="list-group-item">
                                @lang('Referência'): <strong>1 {{$general->cur_text}} = {{getAmount($data->rate)}}  {{$data->baseCurrency()}}</strong>
                            </p>
                            <p class="list-group-item">
                                @lang('Em ') {{$data->baseCurrency()}}:
                                <strong>{{getAmount($data->final_amo)}}</strong>
                            </p>
                            @if($data->gateway->crypto==1)
                                <p class="list-group-item">
                                    @lang('Conversão em')
                                    <b> {{ $data->method_currency }}</b> @lang('finalize no próximo passo.')
                                </p>
                            @endif
                        </ul>

                        @if( 1000 >$data->method_code)
                            <a href="{{route('user.deposit.confirm')}}" class="btn btn--success btn-block py-3 font-weight-bold">@lang('Confirmar Depósito')</a>
                        @else
                            <a href="{{route('user.deposit.manual.confirm')}}" class="btn btn--success btn-block py-3 font-weight-bold">@lang('Confirmar Depósito')</a>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop


