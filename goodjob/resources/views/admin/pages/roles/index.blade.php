@extends('admin.layouts.default')

@push('title')
    Packages list
@endpush

@section('content')

@include('admin.pages.roles.partials.table')

@endsection

@push('js')

@endpush