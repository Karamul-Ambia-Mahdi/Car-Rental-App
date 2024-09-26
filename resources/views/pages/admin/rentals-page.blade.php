@extends('layout.admin.sidenav-layout')
@section('content')
    @include('components.admin.rental.rental-list')
    @include('components.admin.rental.rental-create')
    @include('components.admin.rental.rental-status-update')
    @include('components.admin.rental.rental-update')
    @include('components.admin.rental.rental-delete')
@endsection