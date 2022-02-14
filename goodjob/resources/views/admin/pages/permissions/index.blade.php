@extends('admin.layouts.default')

@push('title')
    Permissions list
@endpush

@section('content')

@include('admin.pages.permissions.partials.table')

@endsection

@push('js')

@endpush