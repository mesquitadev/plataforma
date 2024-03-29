@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <form action="{{ route('admin.withdraw.method.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <h6 class="card-title mb-20">@lang('Adicionar Novo')</h6>
                        <div class="payment-method-item">
                            <div class="payment-method-header d-flex flex-wrap">
                                <div class="thumb">
                                    <div class="avatar-preview">
                                        <div class="profilePicPreview" style="background-image: url({{getImage('/',imagePath()['withdraw']['method']['size'])}})"></div>
                                    </div>
                                    <div class="avatar-edit">
                                        <input type="file" name="image" class="profilePicUpload" id="image" accept=".png, .jpg, .jpeg"/>
                                        <label for="image" class="bg--primary"><i class="la la-pencil"></i></label>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="form-group">
                                        <label class="font-weight-bold">@lang('Nome')</label>
                                        <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-4">
                                           <div class="form-group">
                                               <label class="font-weight-bold">@lang('Moeda') <span class="text-danger">*</span></label>

                                               <div class="input-group">
                                                   <input type="text" name="currency" class="form-control border-radius-5" value="{{ old('currency') }}"/>
                                               </div>
                                           </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Referência') <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">1 {{ __($general->cur_text) }} =</div>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="0" name="rate" value="{{ old('rate') }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><span class="currency_symbol"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="font-weight-bold">@lang('Tempo de Processamento')  <span class="text-danger">*</span></label>
                                                <input type="text" name="delay" class="form-control border-radius-5" value="{{ old('delay') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="payment-method-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card border--primary mb-2">
                                            <h5 class="card-header bg--primary">@lang('Range')</h5>
                                            <div class="card-body">

                                                <label class="font-weight-bold">@lang('Quantidade Mínima') <span class="text-danger">*</span></label>
                                                <div class="input-group has_append mb-3">
                                                    <input type="text" class="form-control" name="min_limit" placeholder="0" value="{{ old('min_limit') }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>

                                                <label class="font-weight-bold">@lang('Quantidade Máxima') <span class="text-danger">*</span></label>
                                                <div class="input-group has_append">
                                                    <input type="text" class="form-control" placeholder="0" name="max_limit" value="{{ old('max_limit') }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card border--primary">
                                            <h5 class="card-header bg--primary">@lang('Taxa')</h5>
                                            <div class="card-body">
                                                <label class="font-weight-bold">@lang('Taxa Fixa') <span class="text-danger">*</span></label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="0" name="fixed_charge" value="{{ old('fixed_charge') }}"/>
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"> {{ __($general->cur_text) }} </div>
                                                    </div>
                                                </div>
                                                <label class="font-weight-bold">@lang('Taxa Percentual') <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="0" name="percent_charge" value="{{ old('percent_charge') }}">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text">%</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark my-2">

                                            <h5 class="card-header bg--dark">@lang('Instruções para Saque') </h5>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <textarea rows="5" class="form-control border-radius-5 nicEdit" name="instruction">{{ old('instruction') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="card border--dark">
                                            <h5 class="card-header bg--dark">@lang('Dados de Usuário')
                                                <button type="button" class="btn btn-sm btn-outline-light float-right addUserData">
                                                    <i class="la la-fw la-plus"></i>@lang('Adicionar Novo')
                                                </button>
                                            </h5>

                                            <div class="card-body">
                                                <div class="row addedField">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn--primary btn-block">@lang('Salvar Método')</button>
                    </div>
                </form>
            </div><!-- card end -->
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <a href="{{ route('admin.withdraw.method.index') }}" class="btn btn-sm btn--primary box--shadow1 text--small">
        <i class="la la-fw la-backward"></i> @lang('Voltar')
    </a>
@endpush

@push('script')
    <script>
        'use strict';
        (function($){
            $('input[name=currency]').on('input', function () {
                $('.currency_symbol').text($(this).val());
            });

            $('.addUserData').on('click', function () {
                var html = `
                    <div class="col-md-12 user-data">
                        <div class="form-group">
                            <div class="input-group mb-md-0 mb-4">
                                <div class="col-md-4">
                                    <input name="field_name[]" class="form-control" type="text" value="" required placeholder="@lang('Field Name')">
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="type[]" class="form-control">
                                        <option value="text" > @lang('Campo de Texto') </option>
                                        <option value="textarea" > @lang('Area de Texto') </option>
                                        <option value="file"> @lang('Campo de Arquivo') </option>
                                    </select>
                                </div>
                                <div class="col-md-3 mt-md-0 mt-2">
                                    <select name="validation[]"
                                            class="form-control">
                                        <option value="required"> @lang('Obrigatório') </option>
                                        <option value="nullable">  @lang('Opcional') </option>
                                    </select>
                                </div>
                                <div class="col-md-2 mt-md-0 mt-2 text-right">
                                    <span class="input-group-btn">
                                        <button class="btn btn--danger btn-lg removeBtn w-100" type="button">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>`;

                $('.addedField').append(html);
            });


            $(document).on('click', '.removeBtn', function () {
                $(this).closest('.user-data').remove();
            });

            @if(old('currency'))
                $('input[name=currency]').trigger('input');
            @endif
        })(jQuery)


    </script>
@endpush
