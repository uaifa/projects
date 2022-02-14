@extends('admin.layouts.default')

@push('title')
    Clients list
@endpush

@section('content')

@include('admin.pages.clients.partials.table')

@endsection

@push('js')

@endpush