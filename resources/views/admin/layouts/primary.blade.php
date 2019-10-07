@extends('admin.layouts.base')
@push('head_styles')
    <link rel="stylesheet" href="{{ asset('css/skins/skin-blue.min.css') }}">
@endpush
@section('child-layout')
    <div class="wrapper">
        @yield('content')
    </div>
@endsection