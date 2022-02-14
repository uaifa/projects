@extends('admin.layouts.default')

@push('title')
    Add Clients
@endpush

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('admin/css/custom-style.css') }}">
@endpush


@section('content')

	@include('admin.pages.clients.partials.form')

@endsection

