@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill-wave"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_text}}</span>
                        <span class="amount">{{getAmount(auth()->user()->total_invest)}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Capital Investido')</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_text}}</span>
                        <span class="amount">{{getAmount(auth()->user()->balance)}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Bônus Pessoais')</span>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_text}}</span>
                        <span class="amount">{{getAmount(auth()->user()->total_ref_com)}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Bônus Indicados')</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_text}}</span>
                        <span class="amount">{{getAmount($completeWithdraw)}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Total Sacado')</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-sm-6 mb-30">
            <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
                <div class="icon">
                    <i class="las la-money-bill"></i>
                </div>
                <div class="details">
                    <div class="numbers">
                        <span class="currency-sign">{{$general->cur_text}}</span>
                        <span class="amount">{{getAmount($completeWithdraw)}}</span>
                    </div>
                    <div class="desciption">
                        <span class="text--small">@lang('Disponivel para Saque')</span>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Codigo')</th>
                                <th scope="col">@lang('Data')</th>

                                <th scope="col">@lang('Valor')</th>
                                <th scope="col">@lang('Taxa')</th>

                                <th scope="col">@lang('Investimento')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions  as $trx)

                                <tr>
                                    <td data-label="@lang('SL')">{{ $transactions->firstItem()+$loop->index }}</td>
                                    <td data-label="@lang('Data')">{{ showDateTime($trx->created_at) }}</td>

                                    <td data-label="@lang('Valor')" class="budget">
                                        <strong @if($trx->trx_type == '+') class="text-danger"
                                                @else class="text-success" @endif> {{($trx->trx_type == '+') ? '+':'-'}} {{getAmount($trx->amount)}} {{$general->cur_text}}</strong>
                                    </td>
                                    <td data-label="@lang('Taxa')"
                                        class="budget">{{ $general->cur_sym }} {{ getAmount($trx->charge) }} </td>
                                    <td data-label="@lang('Detalhe')">{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $transactions->appends($_GET)->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Buscar Por Transação')"
                   value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

