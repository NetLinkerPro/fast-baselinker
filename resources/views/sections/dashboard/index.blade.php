@extends('fast-baselinker::vendor.indigo-layout.main')

@section('meta_title',  __('fast-baselinker::dashboard.startup_baselinker') . ' // ' .config('app.name') )
@section('meta_description', _p('pages.dashboard.meta_description', 'Check your dashboard with all important metrics and values.'))

@push('head')
    @include('fast-baselinker::integration.favicons')
    @include('fast-baselinker::integration.ga')
@endpush

@section('content')


@endsection
