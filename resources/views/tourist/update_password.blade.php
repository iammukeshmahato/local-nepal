@extends('tourist.layouts.main')
@push('title')
    <title>Update Password - Tourist | LocalNepal</title>
@endpush
@section('main-content')
    <div class="row">
        <div class="col-md-12 authentication-inner">
            @include('components.update-password')
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
@endpush
