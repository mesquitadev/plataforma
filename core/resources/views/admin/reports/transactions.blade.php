@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Data')</th>
                                <th scope="col">@lang('Transação')</th>
                                <th scope="col">@lang('Usuário')</th>
                                <th scope="col">@lang('Quantiade')</th>
                                <th scope="col">@lang('Taxa')</th>
                                <th scope="col">@lang('Pós Saldo')</th>
                                <th scope="col">@lang('Detalhe')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td data-label="@lang('Data')">{{ showDateTime($trx->created_at) }}</td>
                                    <td data-label="@lang('Transação')" class="font-weight-bold">{{ $trx->trx }}</td>
                                    <td data-label="@lang('Usuário')"><a href="{{ route('admin.users.detail', $trx->user_id) }}">{{ @$trx->user->username }}</a></td>
                                    <td data-label="@lang('Quantidade')" class="budget">
                                        <strong @if($trx->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($trx->trx_type == '+') ? '+':'-'}} {{getAmount($trx->amount)}} {{$general->cur_text}}</strong>
                                    </td>
                                    <td data-label="@lang('Taxa')" class="budget">{{ $general->cur_sym }} {{ getAmount($trx->charge) }} </td>
                                    <td data-label="@lang('Pós Saldo')">{{ $trx->post_balance +0 }} {{$general->cur_text}}</td>
                                    <td data-label="@lang('Detalhe')">{{ __($trx->details) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($empty_message) }}</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table><!-- table end -->
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{ $transactions->links('admin.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection


@push('breadcrumb-plugins')
    @if(request()->routeIs('admin.users.transactions'))
        <form action="" method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="@lang('Transação / Usuário')" value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    @else
        <form action="{{ route('admin.report.transaction.search') }}" method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="@lang('Transação / Usuário')" value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    @endif
@endpush


