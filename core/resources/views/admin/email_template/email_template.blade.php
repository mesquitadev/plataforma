@extends('admin.layouts.app')

@section('panel')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive table-responsive--sm">
                        <table class=" table align-items-center table--light">
                            <thead>
                            <tr>
                                <th>@lang('Variável') </th>
                                <th>@lang('Descrição')</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            <tr>
                                <td data-label="@lang('Variável')">@{{name}}</td>
                                <td data-label="@lang('Descrição')">@lang('User Name')</td>
                            </tr>
                            <tr>
                                <td data-label="@lang('Variável')">@{{message}}</td>
                                <td data-label="@lang('Descrição')">@lang('Mensagem')</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="{{ route('admin.email.template.global') }}" method="POST">
                        @csrf
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Enviar por') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-lg" placeholder="@lang('Email')" name="email_from" value="{{ $general_setting->email_from }}" required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Corpo do Email') <span class="text-danger">*</span></label>
                                <textarea name="email_template" rows="10" class="form-control form-control-lg nicEdit" placeholder="@lang('Template')">{{ $general_setting->email_template }}</textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Atualizar')</button>
                    </form>
                </div>
            </div><!-- card end -->
        </div>
    </div>

@endsection


