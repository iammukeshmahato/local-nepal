@extends('tourist.layouts.main')
@push('title')
    <title>Bookings - Tourist | LocalNepal</title>
@endpush
@section('main-content')
    @include('components.booking_table')
@endsection
