@extends($activeTemplate . 'user.layouts.app')

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
                                <th scope="col">@lang('IP')</th>
                                <th scope="col">@lang('Localização')</th>
                                <th scope="col">@lang('Navegador')</th>
                                <th scope="col">@lang('OS')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($login_logs as $log)
                                <tr>
                                    <td data-label="@lang('Data')">{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</td>
                                    <td data-label="@lang('IP')">{{ $log->user_ip }}</td>
                                    <td data-label="@lang('Localização')">{{ $log->location }}</td>
                                    <td data-label="@lang('Navegador')">{{ $log->browser }}</td>
                                    <td data-label="@lang('OS')">{{ $log->os }}</td>
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
                    {{ $login_logs->links($activeTemplate .'user.partials.paginate') }}
                </div>
            </div><!-- card end -->
        </div>


    </div>
@endsection

@push('breadcrumb-plugins')
    @if(request()->routeIs('admin.users.login.history'))
    <form action="{{ route('admin.users.login.history') }}" method="GET" class="form-inline float-sm-right bg--white">
        <div class="input-group has_append">
            <input type="text" name="search" class="form-control" placeholder="@lang('Usuário')" value="{{ $search ?? '' }}">

            <div class="input-group-append">
                <button class="btn btn--primary" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </form>
    @endif
@endpush
