@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Gateway')</th>
                                <th scope="col">@lang('Quantidade')</th>
                                <th scope="col">@lang('Taxa')</th>
                                <th scope="col">@lang('Referência')</th>
                                <th scope="col">@lang('Recebível')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Tempo')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($withdraws as $k=>$data)
                                <tr>
                                    <td data-label="@lang('Gateway')">{{ $data->method->name   }}</td>
                                    <td data-label="@lang('Quantidade')">
                                        <strong>{{getAmount($data->amount)}} {{$general->cur_text}}</strong>
                                    </td>
                                    <td data-label="@lang('Taxa')" class="text--danger">
                                        {{getAmount($data->charge)}} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Referência')">
                                        {{getAmount($data->rate)}} {{$data->currency}}
                                    </td>
                                    <td data-label="@lang('Recebível')" class="text--success">
                                        <strong>{{getAmount($data->final_amount)}} {{$data->currency}}</strong>
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($data->status == 2)
                                            <span class="badge badge--warning">@lang('Pendente')</span>
                                        @elseif($data->status == 1)
                                            <span class="badge badge--success">@lang('Completado')</span>
                                            <button class="btn-info btn-rounded  badge approveBtn"
                                                    data-admin_feedback="{{$data->admin_feedback}}"><i
                                                    class="fa fa-info"></i></button>
                                        @elseif($data->status == 3)
                                            <span class="badge badge--danger">@lang('Rejeitado')</span>
                                            <button class="btn-info btn-rounded badge approveBtn"
                                                    data-admin_feedback="{{$data->admin_feedback}}"><i
                                                    class="fa fa-info"></i></button>
                                        @endif

                                    </td>
                                    <td data-label="@lang('Tempo')">
                                        <i class="las la-calendar"></i> {{showDateTime($data->created_at)}}
                                    </td>
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
                    {{$withdraws->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </div>

    {{-- Detail MODAL --}}
    <div id="detailModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Detalhes')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="withdraw-detail"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">@lang('Fechar')</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        'use strict';
        (function($){
            $('.approveBtn').on('click', function () {
                var modal = $('#detailModal');
                var feedback = $(this).data('admin_feedback');

                modal.find('.withdraw-detail').html(`<p> ${feedback} </p>`);
                modal.modal('show');
            });
        })(jQuery)
    </script>
@endpush

@push('breadcrumb-plugins')
    <form action="" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Buscar por Transação')"
                   value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush

