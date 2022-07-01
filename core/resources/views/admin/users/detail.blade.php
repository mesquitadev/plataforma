@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">

        <div class="col-xl-3 col-lg-5 col-md-5 mb-30">

            <div class="card b-radius--10 overflow-hidden box--shadow1">
                <div class="card-body p-0">
                    <div class="p-3 bg--white">
                        <div class="">
                            <img src="{{ getImage('assets/images/user/profile/'. $user->image,'350x300')}}" alt="@lang('profile-image')"
                                 class="b-radius--10 w-100">
                        </div>
                        <div class="mt-15">
                            <h4 class="">{{$user->fullname}}</h4>
                            <span class="text--small">@lang('Cadastrado em ')<strong>{{showDateTime($user->created_at,'d M, Y h:i A')}}</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Informação do Usuário')</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Usuário')
                            <span class="font-weight-bold">{{$user->username}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          @lang('Patrocinador')
                            <span class="font-weight-bold"> {{$ref_id->username ?? 'N/A'}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Saldo')
                            <span class="font-weight-bold"> {{getAmount($user->balance)}}  {{$general->cur_text}} </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Total Pontos')
                            <span class="font-weight-bold"><a href="{{route('admin.report.single.bvLog', $user->id)}}"> {{getAmount($user->userExtra->bv_left + $user->userExtra->bv_right)}} </a></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           @lang('Pagamento Usuário Esquerdo')
                            <span class="font-weight-bold">{{$user->userExtra->paid_left}}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                           @lang('Pagamento Usuário Direito')
                            <span class="font-weight-bold">{{$user->userExtra->paid_right}}</span>
                        </li>
{{--                        <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                            @lang('Free Left User')--}}
{{--                            <span class="font-weight-bold">{{$user->userExtra->free_left}}</span>--}}
{{--                        </li>--}}
{{--                        <li class="list-group-item d-flex justify-content-between align-items-center">--}}
{{--                            @lang('Free Right User')--}}
{{--                            <span class="font-weight-bold">{{$user->userExtra->free_right}}</span>--}}
{{--                        </li>--}}
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Status')
                            @switch($user->status)
                                @case(1)
                                <span class="badge badge-pill bg--success">@lang('Ativo')</span>
                                @break
                                @case(2)
                                <span class="badge badge-pill bg--danger">@lang('Banido')</span>
                                @break
                            @endswitch
                        </li>

                    </ul>
                </div>
            </div>
            <div class="card b-radius--10 overflow-hidden mt-30 box--shadow1">
                <div class="card-body">
                    <h5 class="mb-20 text-muted">@lang('Ação do Usuário')</h5>
                    <a data-toggle="modal" href="#addSubModal" class="btn btn--success btn--shadow btn-block btn-lg">
                        @lang('Adicionar / Subtrair Saldo')
                    </a>
                    <a href="{{ route('admin.users.login.history.single', $user->id) }}"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                        @lang('Histórico de Login')
                    </a>
                    <a href="{{route('admin.users.email.single',$user->id)}}"
                       class="btn btn--danger btn--shadow btn-block btn-lg">
                        @lang('Enviar Email')
                    </a>
                    <a href="{{route('admin.users.single.tree',$user->username)}}"
                       class="btn btn--primary btn--shadow btn-block btn-lg">
                       @lang('Rede do Usuário')
                    </a>
                    <a href="{{route('admin.users.ref',$user->id)}}"
                       class="btn btn--info btn--shadow btn-block btn-lg">
                        @lang('Indicações do Usuário')
                    </a>
                </div>
            </div>
        </div>

        <div class="col-xl-9 col-lg-7 col-md-7 mb-30">
            <div class="row mb-none-30">
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--primary b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.deposits',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-credit-card"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($totalDeposit)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Depositado')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--red b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.withdrawals',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="fa fa-wallet"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($totalWithdraw)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total de Saques')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- dashboard-w1 end -->

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--dark b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.users.transactions',$user->id)}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-exchange-alt"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{$totalTransaction}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Transação')</span>
                            </div>
                        </div>
                    </div>
                </div><!-- dashboard-w1 end -->


                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--info b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.invest')}}?user={{$user->id}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-money"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_invest)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total Investido')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--indigo b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.refCom')}}?userID={{$user->id}}" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-user"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->total_ref_com)}}</span>
                                <span class="currency-sign">{{$general->cur_text}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total de Comissão por Indicação')</span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--19 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.single.bvLog', $user->id)}}?type=cutBV" class="item--link"></a>
                        <div class="icon">
                            <i class="la la-cut"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($totalBvCut)}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Total de Pontos')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--15 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.single.bvLog', $user->id)}}?type=leftBV" class="item--link"></a>
                        <div class="icon">
                            <i class="las la-arrow-alt-circle-left"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->userExtra->bv_left)}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Pontos Esquerdo')</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-sm-6 mb-30">
                    <div class="dashboard-w1 bg--12 b-radius--10 box-shadow has--link">
                        <a href="{{route('admin.report.single.bvLog', $user->id)}}?type=rightBV" class="item--link"></a>
                        <div class="icon">
                            <i class="las la-arrow-alt-circle-right"></i>
                        </div>
                        <div class="details">
                            <div class="numbers">
                                <span class="amount">{{getAmount($user->userExtra->bv_right)}}</span>
                            </div>
                            <div class="desciption">
                                <span>@lang('Pontos Direito')</span>
                            </div>
                        </div>
                    </div>
                </div>




            </div>


            <div class="card mt-50">
                <div class="card-body">
                    <h5 class="card-title mb-50 border-bottom pb-2">@lang('Information')</h5>

                    <form action="{{route('admin.users.update',[$user->id])}}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Nome')<span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="firstname"
                                           value="{{$user->firstname}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Sobrenome') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="lastname" value="{{$user->lastname}}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Email') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="email" value="{{$user->email}}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label  font-weight-bold">@lang('Telefone') <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="mobile" value="{{$user->mobile}}">
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Endereço') </label>
                                    <input class="form-control" type="text" name="address"
                                           value="{{$user->address->address}}">
                                    <small class="form-text text-muted"><i class="las la-info-circle"></i> @lang('Endereço')
                                    </small>
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label font-weight-bold">@lang('Cidade') </label>
                                    <input class="form-control" type="text" name="city"
                                           value="{{$user->address->city}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('Estado') </label>
                                    <input class="form-control" type="text" name="state"
                                           value="{{$user->address->state}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('CEP') </label>
                                    <input class="form-control" type="text" name="zip"
                                           value="{{$user->address->zip}}">
                                </div>
                            </div>

                            <div class="col-xl-3 col-md-6">
                                <div class="form-group ">
                                    <label class="form-control-label font-weight-bold">@lang('País') </label>
                                    <select name="country" class="form-control"> @include('partials.country') </select>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Ativo" data-off="Inativo" data-width="100%"
                                       name="status"
                                       @if($user->status) checked @endif>
                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Verificação de Email') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verificado" data-off="Não Verificado" name="ev"
                                       @if($user->ev) checked @endif>

                            </div>

                            <div class="form-group  col-xl-4 col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('Verificação de SMS') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verificado" data-off="Não Verificado" name="sv"
                                       @if($user->sv) checked @endif>

                            </div>
                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('2FA Status') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Ativo" data-off="Inativo" name="ts"
                                       @if($user->ts) checked @endif>
                            </div>

                            <div class="form-group  col-md-6  col-sm-3 col-12">
                                <label class="form-control-label font-weight-bold">@lang('2FA Verification') </label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger"
                                       data-toggle="toggle" data-on="Verificado" data-off="Não Verificado" name="tv"
                                       @if($user->tv) checked @endif>
                            </div>
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn--primary btn-block btn-lg">@lang('Salvar Alterações')
                                    </button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- Add Sub Balance MODAL --}}
    <div id="addSubModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Adicionar / Subtrair Saldo')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('admin.users.addSubBalance', $user->id)}}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <input type="checkbox" data-width="100%" data-height="44px" data-onstyle="-success"
                                       data-offstyle="-danger" data-toggle="toggle" data-on="Adicionar Saldo"
                                       data-off="Subtrair Saldo" name="act" checked>
                            </div>


                            <div class="form-group col-md-12">
                                <label>@lang('Quantidade')<span class="text-danger">*</span></label>
                                <div class="input-group has_append">
                                    <input type="text" name="amount" class="form-control"
                                           placeholder="Favor inserir apenas valores positivos">
                                    <div class="input-group-append">
                                        <div class="input-group-text">{{ $general->cur_text }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                        <button type="submit" class="btn btn--success">@lang('Salvar')</button>
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
            $("select[name=country]").val("{{ @$user->address->country }}");
        })(jQuery)
    </script>
@endpush
