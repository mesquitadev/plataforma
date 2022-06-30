@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Método')</th>
                                <th scope="col">@lang('Moeda')</th>
                                <th scope="col">@lang('Taxa')</th>
                                <th scope="col">@lang('Limite de Saque')</th>
                                <th scope="col">@lang('Tempo de Processamento') </th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Ação')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($methods as $method)
                                <tr>
                                    <td data-label="@lang('Método')">
                                        <div class="user">
                                            <div class="thumb"><img src="{{ getImage(imagePath()['withdraw']['method']['path'].'/'. $method->image,imagePath()['withdraw']['method']['size'])}}" alt="@lang('image')"></div>

                                            <span class="name">{{__($method->name)}}</span>
                                        </div>
                                    </td>

                                    <td data-label="@lang('Moeda')"
                                        class="font-weight-bold">{{ __($method->currency) }}</td>
                                    <td data-label="@lang('Taxa')"
                                        class="font-weight-bold">{{ getAmount($method->fixed_charge)}} {{__($general->cur_text) }} {{ (0 < $method->percent_charge) ? ' + '. getAmount($method->percent_charge) .' %' : '' }} </td>
                                    <td data-label="@lang('Limite de Saque')"
                                        class="font-weight-bold">{{ $method->min_limit + 0 }}
                                        - {{ $method->max_limit + 0 }} {{__($general->cur_text) }}</td>
                                    <td data-label="@lang('Tempo de Processamento')">{{ $method->delay }}</td>
                                    <td data-label="@lang('Status')">
                                        @if($method->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Ativo')</span>
                                        @else
                                            <span class="text--small badge font-weight-normal badge--warning">@lang('Inativo')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Ação')">
                                        <a href="{{ route('admin.withdraw.method.edit', $method->id)}}"
                                           class="icon-btn ml-1" data-toggle="tooltip" data-original-title="@lang('Editar')"><i class="las la-pen"></i></a>
                                        @if($method->status == 1)
                                            <a href="javascript:void(0)" class="icon-btn btn--danger deactivateBtn  ml-1" data-toggle="tooltip" data-original-title="@lang('Desativar')" data-id="{{ $method->id }}" data-name="{{ __($method->name) }}">
                                                <i class="la la-eye-slash"></i>
                                            </a>
                                        @else
                                            <a href="javascript:void(0)" class="icon-btn btn--success activateBtn  ml-1"
                                               data-toggle="tooltip" data-original-title="@lang('Ativar')"
                                               data-id="{{ $method->id }}" data-name="{{ __($method->name) }}">
                                                <i class="la la-eye"></i>
                                            </a>
                                        @endif
                                    </td>
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
            </div><!-- card end -->
        </div>
    </div>


    {{-- ACTIVATE METHOD MODAL --}}
    <div id="activateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Ativar Método')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.activate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Você deseja ativar') <span class="font-weight-bold method-name"></span> @lang(' o método')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                        <button type="submit" class="btn btn--primary">@lang('Ativar')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- DEACTIVATE METHOD MODAL --}}
    <div id="deactivateModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Desativar Método')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.withdraw.method.deactivate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>@lang('Você deseja desativar ') <span class="font-weight-bold method-name"></span> @lang(' o método')?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                        <button type="submit" class="btn btn--danger">@lang('Desativar')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



@push('breadcrumb-plugins')
    <a class="btn btn-sm btn--primary box--shadow1 text--small" href="{{ route('admin.withdraw.method.create') }}"><i class="fa fa-fw fa-plus"></i>@lang('Adicionar Novo')</a>
@endpush


@push('script')
    <script>
        'use strict';
        (function($){
            $('.activateBtn').on('click', function () {
                var modal = $('#activateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.deactivateBtn').on('click', function () {
                var modal = $('#deactivateModal');
                modal.find('.method-name').text($(this).data('name'));
                modal.find('input[name=id]').val($(this).data('id'))
                modal.modal('show');
            });

        })(jQuery)

    </script>
@endpush
