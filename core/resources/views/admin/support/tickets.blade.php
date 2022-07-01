@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card b-radius--10 ">
                <div class="card-body p-0">
                    <div class="table-responsive--sm table-responsive">
                        <table class="table table--light">
                            <thead>
                            <tr>
                                <th scope="col">@lang('Assunto')</th>
                                <th scope="col">@lang('Aberto por')</th>
                                <th scope="col">@lang('Status')</th>
                                <th scope="col">@lang('Ultima Interação')</th>
                                <th scope="col">@lang('Ação')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td data-label="@lang('Assunto')">
                                        <a href="{{ route('admin.ticket.view', $item->id) }}" class="font-weight-bold"> [Ticket#{{ $item->ticket }}] {{ $item->subject }} </a>
                                    </td>

                                    <td data-label="@lang('Aberto por')">
                                        @if($item->user_id)
                                        <a href="{{ route('admin.users.detail', $item->user_id)}}"> {{@$item->user->fullname}}</a>
                                        @else
                                            <p class="font-weight-bold"> {{$item->name}}</p>
                                        @endif
                                    </td>
                                    <td data-label="@lang('Status')">
                                        @if($item->status == 0)
                                            <span class="badge badge--success">@lang('Aberto')</span>
                                        @elseif($item->status == 1)
                                            <span class="badge  badge--primary">@lang('Respondido')</span>
                                        @elseif($item->status == 2)
                                            <span class="badge badge--warning">@lang('Respondido por Cliente')</span>
                                        @elseif($item->status == 3)
                                            <span class="badge badge--dark">@lang('Fechado')</span>
                                        @endif
                                    </td>

                                    <td data-label="@lang('Ultima Interação')">
                                        {{ diffForHumans($item->last_reply) }}
                                    </td>

                                    <td data-label="@lang('Ação')">
                                        <a href="{{ route('admin.ticket.view', $item->id) }}" class="icon-btn  ml-1" data-toggle="tooltip" title="" data-original-title="@lang('Detalhes')">
                                            <i class="las la-desktop"></i>
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
                <div class="card-footer py-4">
                    {{ paginateLinks($items) }}
                </div>
            </div><!-- card end -->
        </div>
    </div>
@endsection


