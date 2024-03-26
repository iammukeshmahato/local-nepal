@extends('admin.layouts.main')
@push('title')
    <title>Bookings - Admin | LocalNepal</title>
@endpush
@section('main-content')
    @include('components.booking_table')
@endsection
