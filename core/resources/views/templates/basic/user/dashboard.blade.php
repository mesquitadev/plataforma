@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        @if($general->notice != null)
            <div class="col-lg-12 col-sm-6 mb-30">
                <div class="card border--light">
                    <div class="card-header">@lang('Avisos')</div>
                    <div class="card-body">
                        <p class="card-text">@php echo $general->notice; @endphp</p>
                    </div>
                </div>
            </div>
        @endif
{{--        @if($general->free_user_notice != null)--}}
{{--            <div class="col-lg-12 col-sm-6 mb-30">--}}
{{--                <div class="card border--light">--}}
{{--                    @if($general->notice == null)--}}
{{--                        <div class="card-header">@lang('Notice')</div>   @endif--}}
{{--                    <div class="card-body">--}}
{{--                        <p class="card-text"> @php echo $general->free_user_notice; @endphp </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        @endif--}}







        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-wallet"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount(auth()->user()->balance)}}</span>
                        <span class="currency-sign">{{$general->cur_text}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Saldo')</span>
                    </div>
                    <a href="{{route('user.report.transactions')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--primary b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cloud-upload-alt "></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($totalDeposit)}}</span>
                        <span class="currency-sign">{{$general->cur_text}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Depositado')</span>
                    </div>
                    <a href="{{route('user.report.deposit')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cloud-download-alt"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount($totalWithdraw)}}</span>
                        <span class="currency-sign">{{$general->cur_text}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Saques')</span>
                    </div>
                    <a href="{{route('user.report.withdraw')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--teal b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-check"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$completeWithdraw}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Saques Concluidos')</span>
                    </div>
                    <a href="{{route('user.report.withdraw')}}?type=complete"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--warning b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-spinner"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$pendingWithdraw}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Saques Pendentes')</span>
                    </div>
                    <a href="{{route('user.report.withdraw')}}?type=complete"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-ban"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$rejectWithdraw}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Saques Negados')</span>
                    </div>
                    <a href="{{route('user.report.withdraw')}}?type=reject"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill-wave"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount(auth()->user()->total_invest)}}</span>
                        <span class="currency-sign">{{$general->cur_text}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Investido')</span>
                    </div>
                    <a href="{{route('user.report.invest')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{getAmount(auth()->user()->total_ref_com)}}</span>
                        <span class="currency-sign">{{$general->cur_text}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Comissão por Indicação')</span>
                    </div>
                    <a href="{{route('user.report.refCom')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--3 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-users"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="amount">{{$total_ref}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total de Indicados')</span>
                    </div>
                    <a href="{{route('user.my.ref')}}"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>




        <div class="col-xl-3 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--17 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-cart-arrow-down"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span
                            class="amount">{{auth()->user()->userExtra->bv_left + auth()->user()->userExtra->bv_right}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Pontos')</span>
                    </div>
                    <a href="{{route('user.bv.log')}}?type=paidBV"
                       class="btn btn-sm text--small bg--white text--black box--shadow3 mt-3">@lang('Ver Todos')</a>
                </div>
            </div>
        </div>

    </div>

@endsection

