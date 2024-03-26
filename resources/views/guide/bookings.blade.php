@extends('guide.layouts.main')
@push('title')
    <title>Bookings - Guide | LocalNepal</title>
@endpush
@section('main-content')
    @include('components.booking_table');
@endsection
