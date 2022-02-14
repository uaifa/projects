@extends('admin.layouts.default')

@push('title')
    Staff Member list
@endpush

@section('content')

@include('admin.pages.staff_members.partials.table')

@endsection

@push('js')

@endpush