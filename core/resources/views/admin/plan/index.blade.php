@extends('admin.layouts.app')

@section('panel')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive--md table-responsive">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Sl')</th>
                                <th scope="col">@lang('Nome')</th>
                                <th scope="col">@lang('Preço')</th>
                                <th scope="col">@lang('Pontos')</th>
                                <th scope="col">@lang('Comissão de Indicação')</th>
                                <th scope="col">@lang('Comissão da Rede')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Ação')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($plans as $key => $plan)
                                <tr>
                                    <td data-label="@lang('Sl')">{{$key+1}}</td>
                                    <td data-label="@lang('Nome')">{{ __($plan->name) }}</td>
                                    <td data-label="@lang('Preço')">{{ getAmount($plan->price) }} {{$general->cur_text}}</td>
                                    <td data-label="@lang('Pontos')">{{ $plan->bv }}</td>
                                    <td data-label="@lang('Comissão de Indicação')"> {{ getAmount($plan->ref_com) }} {{$general->cur_text}}</td>

                                    <td data-label="@lang('Comissão de Rede')">
                                       {{ getAmount($plan->tree_com) }} {{$general->cur_text}}
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($plan->status == 1)
                                            <span class="text--small badge font-weight-normal badge--success">@lang('Ativo')</span>
                                        @else
                                            <span class="text--small badge font-weight-normal badge--danger">@lang('Inativo')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Ação')">
                                        <button type="button" class="icon-btn edit" data-toggle="tooltip"
                                                data-id="{{ $plan->id }}"
                                                data-name="{{ $plan->name }}"
                                                data-status="{{ $plan->status }}"
                                                data-bv="{{ $plan->bv }}"
                                                data-price="{{ getAmount($plan->price) }}"
                                                data-ref_com="{{ getAmount($plan->ref_com) }}"
                                                data-tree_com="{{ getAmount($plan->tree_com) }}"
                                                data-original-title="Edit">
                                            <i class="la la-pencil"></i>
                                        </button>
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
                <div class="card-footer py-4">
                    {{ $plans->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>


{{--    edit modal--}}
    <div id="edit-plan" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Editar Plano')</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <form method="post" action="{{route('admin.plan.update')}}">
                    @csrf
                    <div class="modal-body">

                        <input class="form-control plan_id" type="hidden" name="id">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Nome') :</label>
                                <input class="form-control name" name="name" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Preço') </label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text">{{$general->cur_sym}} </span></div>
                                    <input type="text" class="form-control  price" name="price" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Pontos')</label>
                            <input class="form-control bv" name="bv" required>
                            <small class="text--red">@lang('Quando alguém compra este plano, todos os seus ancestrais receberão esse valor que será usado para um bônus de correspondência.')</small>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Comissão por Indicação')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                    class="input-group-text">{{$general->cur_sym}} </span></div>
                                    <input type="text" class="form-control  ref_com" name="ref_com"
                                    required>
                                    <small class="text--red">@lang('Se um usuário que se inscreveu neste plano, indicar alguém e se o usuário indicado comprar um plano, ele receberá esse valor.')</small>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="font-weight-bold">@lang('Comissão da Rede')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  tree_com" name="tree_com"
                                    required>
                            </div>
                            <small class="small text--red">@lang('Quando alguém compra esse plano, todos os seus ancestrais receberão esse valor.')</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Status')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Ativo')" data-off="@lang('Inativo')" name="status" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-block btn--primary">@lang('Atualizar')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="add-plan" class="modal  fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Adicionar Novo')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('admin.plan.store')}}">
                    @csrf
                    <div class="modal-body">

                        <input class="form-control plan_id" type="hidden" name="id">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Nome') :</label>
                                <input type="text" class="form-control " name="name"
                                       required>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="font-weight-bold"> @lang('Preço') </label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span
                                            class="input-group-text">{{$general->cur_sym}} </span></div>
                                    <input type="text" class="form-control  " name="price" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Business Volume (BV)')</label>
                            <input class="form-control " type="number" min="0" name="bv" required>

                            <small class="text--red">@lang('Se um usuário que se inscreveu neste plano, indicar alguém e se o usuário indicado comprar um plano, ele receberá esse valor.')</small>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Comissão por Indicação')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="ref_com" required>
                                <small class="small text--red">@lang('Se um usuário que se inscreveu neste plano, indicar alguém e se o usuário indicado comprar um plano, ele receberá esse valor.')</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold"> @lang('Comissão da Rede')</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span
                                        class="input-group-text">{{$general->cur_sym}} </span></div>
                                <input type="text" class="form-control  " name="tree_com" required>
                            </div>
                            <small class="small text--red">@lang('Quando alguém compra esse plano, todos os seus ancestrais receberão esse valor.')</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group col">
                                <label class="font-weight-bold">@lang('Status')</label>
                                <input type="checkbox" data-width="100%" data-onstyle="-success" data-offstyle="-danger" data-toggle="toggle" data-on="@lang('Ativo')" data-off="@lang('Inativo')" name="status" checked>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-block btn btn--primary">@lang('Salvar')</button>
                    </div>
                </form>

            </div>
        </div>
    </div>


@endsection



@push('breadcrumb-plugins')
    <a href="javascript:void(0)" class="btn btn-sm btn--success add-plan"><i class="fa fa-fw fa-plus"></i>@lang('Adicionar Novo')</a>

@endpush

@push('script')
    <script>
        "use strict";
        (function ($) {
            $('.edit').on('click', function () {
                var modal = $('#edit-plan');
                modal.find('.name').val($(this).data('name'));
                modal.find('.price').val($(this).data('price'));
                modal.find('.bv').val($(this).data('bv'));
                modal.find('.ref_com').val($(this).data('ref_com'));
                modal.find('.tree_com').val($(this).data('tree_com'));
                modal.find('input[name=daily_ad_limit]').val($(this).data('daily_ad_limit'));

                if($(this).data('status')){
                    modal.find('.toggle').removeClass('btn--danger off').addClass('btn--success');
                    modal.find('input[name="status"]').prop('checked',true);

                }else{
                    modal.find('.toggle').addClass('btn--danger off').removeClass('btn--success');
                    modal.find('input[name="status"]').prop('checked',false);
                }

                modal.find('input[name=id]').val($(this).data('id'));
                modal.modal('show');
            });

            $('.add-plan').on('click', function () {
                var modal = $('#add-plan');
                modal.modal('show');
            });
        })(jQuery);
    </script>
@endpush

