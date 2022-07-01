@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-responsive--sm">
                        <table class="table align-items-center table--light">
                            <thead>
                            <tr>
                                <th>@lang('Variável')</th>
                                <th>@lang('Descrição')</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>@{{number}}</th>
                                <td>@lang('Número')</td>
                            </tr>
                            <tr>
                                <th>@{{message}}</th>
                                <td>@lang('Mensagem')</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.sms.template.global') }}" method="POST">
                        @csrf
                        <div class="card-header">
                            <h4 class="float-left">{{ $page_title }}</h4>
                            <div class="text-right">
                                <button type="button" data-target="#testSMSModal" data-toggle="modal" class="btn btn--info">@lang('Enviar SMS de Teste')</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>@lang('SMS API') <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="@lang('Configuração de API SMS')" name="sms_api" value="{{ $general_setting->sms_api }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Enviar')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- TEST MAIL MODAL --}}
    <div id="testSMSModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('Configuração de Email de Teste')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.sms.template.sendTestSMS') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>@lang('Enviar Para') <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" class="form-control" placeholder="@lang('Telefone')">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Fechar')</button>
                        <button type="submit" class="btn btn--success">@lang('Enviar')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
