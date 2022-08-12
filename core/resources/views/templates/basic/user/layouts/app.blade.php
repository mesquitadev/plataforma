@extends($activeTemplate .'user.layouts.master')

@section('content')
    @include($activeTemplate .'user.partials.header')
    @include($activeTemplate .'user.partials.breadcrumb')
    @yield('panel')
@endsection
