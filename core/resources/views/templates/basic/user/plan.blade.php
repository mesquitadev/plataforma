@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        @foreach($plans as $data)
            <div class="col-xl-4 col-md-6 mb-30">
                <div class="card">
                    <div class="card-body pt-5 pb-5 ">
                        <div class="pricing-table text-center mb-4">
                            <h2 class="package-name mb-20 text-"><strong>@lang($data->name)</strong></h2>
                            <span class="price text--dark font-weight-bold d-block">{{$general->cur_sym}}{{getAmount($data->price)}}</span>
                            <hr>
{{--                            <ul class="package-features-list mt-30">--}}
{{--                                <li><i class="fas fa-check bg--success"></i> <span>@lang('Bônus por Volume da Rede'): {{getAmount($data->bv)}}</span>   <span class="icon" data-toggle="modal" data-target="#bvInfoModal"><i--}}
{{--                                            class="fas fa-question-circle"></i></span></li>--}}
{{--                                <li><i class="fas fa-check bg--success"></i> <span> @lang('Comissão por Indicação'): {{$general->cur_sym}} {{getAmount($data->ref_com)}} </span>--}}
{{--                                    <span class="icon" data-toggle="modal" data-target="#refComInfoModal"><i--}}
{{--                                    class="fas fa-question-circle"></i></span>--}}
{{--                                </li>--}}
{{--                                <li>--}}
{{--                                    <i class="fas @if(getAmount($data->tree_com) != 0) fa-check bg--success @else fa-times bg--danger @endif "></i>  <span>@lang('Comissão da Rede'): {{$general->cur_sym}} {{getAmount($data->tree_com)}} </span>--}}
{{--                                     <span class="icon" data-toggle="modal" data-target="#treeComInfoModal"><i--}}
{{--                                    class="fas fa-question-circle"></i></span>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
                        </div>
                        @if(Auth::user()->plan_id != $data->id)
                            <a href="#confBuyModal{{$data->id}}" data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Assinar')</a>
                        @else
                            <a data-toggle="modal" class="btn w-100 btn-outline--primary  mt-20 py-2 box--shadow1">@lang('Já Assinado')</a>
                        @endif
                    </div>

                </div><!-- card end -->
            </div>


            <div class="modal fade" id="confBuyModal{{$data->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel"> @lang('Confirmar Assinatura '.$data->name)?</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                            <h5 class="text-danger text-center">{{getAmount($data->price)}} {{$general->cur_text}} @lang('será deduzido do seu saldo')</h5>
                        </div>
                        <form method="post" action="{{route('user.plan.purchase')}}">
                            @csrf
                            <div class="modal-footer">
                                <button type="button" class="btn btn--danger" data-dismiss="modal"><i
                                        class="fa fa-times"></i> @lang('Fechar')</button>

                                <button type="submit" name="plan_id" value="{{$data->id}}" class="btn btn--success"><i
                                        class="lab la-telegram-plane"></i> @lang('Assinar')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="modal fade" id="bvInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang("Bonus por Volume da rede")</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="@lang('Fechar')">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-danger">@lang('Quando alguém da sua árvore abaixo assinar este plano, você receberá este volume de negócios que será usado para bônus de correspondência').
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="refComInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Comissão de Indicação')</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5><span
                            class=" text-danger">@lang('Quando seu usuário indicado se inscrever em') <b> @lang('QUALQUER PLANO')</b>, @lang('você vai receber esse valor').</span>
                        <br>
                        <br>
                        <span class="text-success"> @lang('Esta é a razão pela qual você deve escolher um plano com maior comissão de referência').</span>
                    </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="treeComInfoModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Comissão para Rede')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class=" text-danger">@lang('Quando alguém da sua árvore abaixo assinar este plano, você receberá esse valor como comissão da árvore'). </h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
