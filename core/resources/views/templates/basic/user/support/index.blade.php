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
                                <th scope="col">@lang('SL')</th>
                                <th scope="col">@lang('Assunto')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Última Interação')</th>
                                <th scope="col">@lang('Ação')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supports as $key => $support)
                                <tr>
                                    <td data-label="@lang('SL')">{{$key+1}}</td>
                                    <td data-label="@lang('Assunto')"> <a href="{{ route('ticket.view', $support->ticket) }}" class="font-weight-bold"> [@lang('Ticket')#{{ $support->ticket }}] {{ $support->subject }} </a></td>
                                    <td data-label="@lang('Status')">
                                        @if($support->status == 0)
                                            <span class="badge badge--success">@lang('Aberto')</span>
                                        @elseif($support->status == 1)
                                            <span class="badge badge--primary ">@lang('Respondido')</span>
                                        @elseif($support->status == 2)
                                            <span class="badge badge--warning">@lang('Responder')</span>
                                        @elseif($support->status == 3)
                                            <span class="badge badge--dark">@lang('Fechado')</span>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Last Reply')">{{ \Carbon\Carbon::parse($support->last_reply)->diffForHumans() }} </td>

                                    <td data-label="@lang('Ação')">
                                        <a href="{{ route('ticket.view', $support->ticket) }}" class="icon-btn" data-toggle="tooltip" title="" data-original-title="@lang('Detalhes')">
                                            <i class="las la-desktop text--shadow"></i>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4">
                    {{$supports->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection


@push('breadcrumb-plugins')
    <a href="{{route('ticket.open') }}" class="btn btn-sm btn--success box--shadow1 text--small"><i class="las la-plus-circle"></i>@lang('Abrir Ticket')</a>
@endpush

@push('script')
@endpush
