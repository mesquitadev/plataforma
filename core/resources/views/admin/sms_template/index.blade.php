@extends('admin.layouts.app')

@section('panel')

    <div class="row mb-none-30">
        <div class="col-lg-12 col-md-12 mb-30">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light style--two custom-data-table">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Nome')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Ação')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($sms_templates as $template)
                                <tr>
                                    <td data-label="@lang('Nome')">
                                        {{ __($template->name) }}
                                    </td>

                                    <td data-label="@lang('Status')">
                                        @if($template->sms_status == 1)
                                            <span class="badge  badge--success">@lang('Ativo')</span>
                                        @else
                                            <span class="badge  badge--warning">@lang('Inativo')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Ação')">
                                        <a href="{{ route('admin.sms.template.edit', $template->id) }}"
                                           class="icon-btn ml-1 editGatewayBtn" data-toggle="tooltip"
                                           title="@lang('Editar')">
                                            <i class="la la-pencil"></i>
                                        </a>

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
            </div>
        </div>
    </div>
@endsection


