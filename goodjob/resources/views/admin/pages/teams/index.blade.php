@extends('admin.layouts.default')

@push('title')
    Teams list
@endpush

@section('content')

@include('admin.pages.teams.partials.table')

@endsection

@push('js')

@endpush