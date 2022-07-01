@extends($activeTemplate . 'user.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive--sm">
                        <table class="table table--light style--two">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Sl')</th>
                                <th scope="col">@lang('Pontos')</th>
                                <th scope="col">@lang('Posição')</th>
                                <th scope="col">@lang('Detalhe')</th>
                                <th scope="col">@lang('Data')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($logs as $key=>$data)
                                <tr><td data-label="@lang('Sl')">{{$logs->firstItem()+$key}}</td>
                                    <td data-label="@lang('Pontos')" class="budget">
                                        <strong @if($data->trx_type == '+') class="text-success" @else class="text-danger" @endif> {{($data->trx_type == '+') ? '+':'-'}} {{getAmount($data->amount)}}</strong>
                                    </td>

                                    <td data-label="@lang('Posição')">
                                        @if ($data->position == 1)<span class="badge badge--success">@lang('Esquerda')</span>
                                        @else
                                            <span class="badge badge--primary">@lang('Direita')</span>
                                        @endif</td>
                                    <td data-label="@lang('Detalhe')">{{$data->details}}</td>
                                    <td data-label="@lang('Data')">{{$data->created_at != ''? date('d/m/y  g:i A',strtotime($data->created_at)): __('Not Assign')}}</td>
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
