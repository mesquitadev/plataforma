@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">

        <div class="col-lg-12 ">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">

                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Sl')</th>
                                <th scope="col">@lang('Usuário')</th>
                                <th scope="col">@lang('Nome')</th>
                                <th scope="col">@lang('Email')</th>
                                <th scope="col">@lang('Data de Cadastro')</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($logs as $key=>$data)
                                <tr>
                                    <td data-label="@lang('Sl')" >{{$logs->firstItem()+$key}}</td>
                                    <td data-label="@lang('Usuário')">{{$data->username}}</td>
                                    <td data-label="@lang('Nome')">{{$data->fullname}}</td>
                                    <td data-label="@lang('Email')">{{printEmail($data->email)}}</td>
                                    <td data-label="@lang('Data de Cadastro')">
                                        @if($data->created_at != '')
                                        {{ showDateTime($data->created_at) }}
                                        @else
                                        @lang('Sem Assinatura')
                                        @endif
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
                    {{ $logs->links('admin.partials.paginate') }}
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')

    <script>
        'use strict';
        (function($) {
            document.body.addEventListener('click', copy, true);
            function copy(e) {
                var
                    t = e.target,
                    c = t.dataset.copytarget,
                    inp = (c ? document.querySelector(c) : null);
                if (inp && inp.select) {
                    inp.select();
                    try {
                        document.execCommand('copy');
                        inp.blur();
                        t.classList.add('copied');
                        setTimeout(function() { t.classList.remove('copied'); }, 1500);
                    }catch (err) {
                        alert(`@lang('Por favor pressione ctrl +c / +v para copiar e colar')`);
                    }
                }
            }
        })(jQuery);
    </script>

@endpush
