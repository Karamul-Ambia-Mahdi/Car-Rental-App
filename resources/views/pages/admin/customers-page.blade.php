@extends('layout.admin.sidenav-layout')
@section('content')
    @include('components.admin.customer.customer-list')
    @include('components.admin.customer.customer-create')
    @include('components.admin.customer.customer-rental-history')
    @include('components.admin.customer.customer-update')
    @include('components.admin.customer.customer-delete')
@endsection