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
                                <th scope="col">@lang('Data')</th>
                                <th scope="col">@lang('PTC Ad')</th>
                                <th scope="col">@lang('Usuário')</th>
                                <th scope="col">@lang('Quantidade')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ptcviews as $data)
                            <tr>
                                <td data-label="@lang('Data')">{{ $data->vdt }}</td>
                                <td data-label="@lang('PTC Ad')"> <a href="{{route('admin.ptc.edit',$data->ptc->id)}}">{{shortDescription($data->ptc->title,20)}}</a></td>

                                <td data-label="@lang('Usuário')">
                                    <a href="{{ route('admin.users.detail', $data->user->id??0) }}">{{ @$data->user->username }}</a>
                                </td>

                                <td class="font-weight-bold" data-label="@lang('Quantidade')">{{ getAmount($data->amount)}} {{$general->cur_text}} </td>
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
                {{ $ptcviews->links('admin.partials.paginate') }}
            </div>
        </div>
    </div>
</div>
@endsection
@push('breadcrumb-plugins')
    <form action="{{route('admin.report.ptcview.search')}}" method="GET" class="form-inline float-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Usuário')" value="{{ $search ?? '' }}">
            <div class="input-group-append">
                <button class="btn btn-success" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
@endpush
