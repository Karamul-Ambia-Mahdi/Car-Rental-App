@extends('layout.admin.sidenav-layout')
@section('content')
    @include('components.admin.car.car-list')
    @include('components.admin.car.car-create')
    @include('components.admin.car.car-update')
    @include('components.admin.car.car-delete')
@endsection
