@extends('admin.layouts.default')

@push('title')
    Skills list
@endpush

@section('content')

@include('admin.pages.skills.partials.table')

@endsection

@push('js')

@endpush