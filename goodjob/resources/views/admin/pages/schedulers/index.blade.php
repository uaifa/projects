@extends('admin.layouts.default')

@push('title')
    Scheduler List
@endpush

@section('content')

@include('admin.pages.schedulers.partials.table')

@endsection

@push('js')

@endpush