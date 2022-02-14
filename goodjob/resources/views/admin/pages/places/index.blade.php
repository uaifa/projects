@extends('admin.layouts.default')

@push('title')
    Packages list
@endpush

@section('content')

@include('admin.pages.places.partials.table')

@endsection

@push('js')

@endpush