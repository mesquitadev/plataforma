@extends('admin.layouts.app')

@section('panel')
    <div class="row justify-content-center">
        @if(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.method') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals.method'))
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--success">
            <div class="widget-two__content">
                <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',1)->sum('amount') }}</h2>
                <p class="text-white">@lang('Saques Aprovados')</p>
            </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--6">
                <div class="widget-two__content">
                    <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',2)->sum('amount') }}</h2>
                    <p class="text-white">@lang('Saques Pendentes')</p>
                </div>
            </div><!-- widget-two end -->
        </div>
        <div class="col-xl-4 col-sm-6 mb-30">
            <div class="widget-two box--shadow2 b-radius--5 bg--pink">
            <div class="widget-two__content">
                <h2 class="text-white">{{ __($general->cur_sym) }}{{ $withdrawals->where('status',3)->sum('amount') }}</h2>
                <p class="text-white">@lang('Saques Negados')</p>
            </div>
            </div><!-- widget-two end -->
        </div>
        @endif
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">

                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Data')</th>
                                <th scope="col">@lang('Transação')</th>
                                @if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method'))
                                <th scope="col">@lang('Usuário')</th>
                                @endif
                                <th scope="col">@lang('Método')</th>
                                <th scope="col">@lang('Quantidade')</th>
                                <th scope="col">@lang('Taxa')</th>
                                <th scope="col">@lang('Depois da Taxa')</th>
                                <th scope="col">@lang('Referência')</th>
                                <th scope="col">@lang('Pagável')</th>
                                @if(request()->routeIs('admin.withdraw.pending'))
                                    <th scope="col">@lang('Ação')</th>
                                @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search')  || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.withdraw.method'))
                                    <th scope="col">@lang('Status')</th>
                                @endif

                                @if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected') || request()->routeIs('admin.users.withdrawals.method'))
                                    <th scope="col">@lang('Info')</th>
                                @endif

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($withdrawals as $withdraw)
                                @php
                                    $details = ($withdraw->withdraw_information != null) ? json_encode($withdraw->withdraw_information) : null;
                                @endphp
                                <tr>
                                    <td data-label="@lang('Data')">{{ showDateTime($withdraw->created_at) }}</td>
                                    <td data-label="@lang('Transação')" class="font-weight-bold">{{ strtoupper($withdraw->trx) }}</td>
                                    @if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method'))
                                    <td data-label="@lang('Usuário')">
                                        <a href="{{ route('admin.users.detail', $withdraw->user_id) }}">{{ @$withdraw->user->username }}</a>
                                    </td>
                                    @endif
                                    <td data-label="@lang('Método')">
                                        @if(request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.users.withdrawals'))
                                       <a href="{{ route('admin.users.withdrawals.method',[$withdraw->method->id,@$type?$type:'all',$userId]) }}"> {{ __(@$withdraw->method->name) }}</a>
                                       @else
                                       <a href="{{ route('admin.withdraw.method',[$withdraw->method->id,@$type]) }}"> {{ __(@$withdraw->method->name) }}</a>
                                       @endif
                                    </td>
                                    <td data-label="@lang('Quantidade')" class="budget font-weight-bold">{{ getAmount($withdraw->amount) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Taxa')" class="budget text-danger">{{ getAmount($withdraw->charge) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Depois da Taxa')" class="budget">{{ getAmount($withdraw->after_charge) }} {{__($general->cur_text)}}</td>
                                    <td data-label="@lang('Referência')" class="budget">{{ getAmount($withdraw->rate) }}  {{__($withdraw->currency)}}</td>

                                    <td data-label="@lang('Pagável')" class="budget font-weight-bold">{{ getAmount($withdraw->final_amount) }} {{ __($withdraw->currency) }} </td>
                                    @if(request()->routeIs('admin.withdraw.pending'))

                                        <td data-label="@lang('Ação')">
                                            <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="icon-btn ml-1 " data-toggle="tooltip"data-original-title="@lang('Detail')">
                                                <i class="la la-eye"></i>
                                            </a>
                                        </td>
                                    @elseif(request()->routeIs('admin.withdraw.log') || request()->routeIs('admin.withdraw.search') || request()->routeIs('admin.users.withdrawals') || request()->routeIs('admin.withdraw.method') ||  request()->routeIs('admin.users.withdrawals.method'))
                                        <td data-label="@lang('Status')">
                                            @if($withdraw->status == 2)
                                                <span class="text--small badge font-weight-normal badge--warning">@lang('Pendente')</span>
                                            @elseif($withdraw->status == 1)
                                                <span class="text--small badge font-weight-normal badge--success">@lang('Aprovado')</span>
                                            @elseif($withdraw->status == 3)
                                                <span class="text--small badge font-weight-normal badge--danger">@lang('Rejeitado')</span>
                                            @endif
                                        </td>
                                    @endif
                                    @if(request()->routeIs('admin.withdraw.approved') || request()->routeIs('admin.withdraw.rejected'))
                                        <td data-label="@lang('Info')">
                                            <a href="{{ route('admin.withdraw.details', $withdraw->id) }}" class="icon-btn ml-1 " data-toggle="tooltip" data-original-title="@lang('Detalhe')">
                                                <i class="la la-desktop"></i>
                                            </a>
                                        </td>
                                    @endif
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
                    {{ paginateLinks($withdrawals) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>

@endsection




@push('breadcrumb-plugins')

    @if(!request()->routeIs('admin.users.withdrawals') && !request()->routeIs('admin.users.withdrawals.method'))

        <form action="{{ route('admin.withdraw.search', $scope ?? str_replace('admin.withdraw.', '', request()->route()->getName())) }}"
            method="GET" class="form-inline float-sm-right bg--white">
            <div class="input-group has_append">
                <input type="text" name="search" class="form-control" placeholder="@lang('Transação / Usuário')" value="{{ $search ?? '' }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <form action="{{route('admin.withdraw.dateSearch',$scope ?? str_replace('admin.withdraw.', '', request()->route()->getName()))}}" method="GET" class="form-inline float-sm-right bg--white mr-0 mr-xl-2 mr-lg-0">
            <div class="input-group has_append">
                <input name="date" type="text" data-range="true" data-multiple-dates-separator=" - " data-language="en" class="datepicker-here bg--white text--black form-control" data-position='bottom right' placeholder="@lang('Data inicial - Data Final')" autocomplete="off" value="{{ @$dateSearch }}" readonly>
                <input type="hidden" name="method" value="{{ @$method->id }}">
                <div class="input-group-append">
                    <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    @endif
@endpush
@push('script')
  <script src="{{ asset('assets/admin/js/vendor/datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/vendor/datepicker.en.js') }}"></script>
  <script>
    'use strict';
    (function($){
        if(!$('.datepicker-here').val()){
            $('.datepicker-here').datepicker();
        }
    })(jQuery)
  </script>
@endpush
