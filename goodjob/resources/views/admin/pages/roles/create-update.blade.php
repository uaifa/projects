@extends('admin.layouts.default')

@push('title')
    Add Packages
@endpush
@push('css')
	<style type="text/css">
		.permission-labels{
			display: -webkit-inline-box;
			padding-top: 0;
			margin-top: 10px;
			margin-left: 6px;
			position: absolute;
		}
	</style>
@endpush

@section('content')

	@include('admin.pages.roles.partials.form')

@endsection

