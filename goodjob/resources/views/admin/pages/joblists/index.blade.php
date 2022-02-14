@extends('admin.layouts.default')

@push('title')
    Packages list
@endpush

@section('content')

@include('admin.pages.joblists.partials.table')

@endsection

@push('js')

@endpush