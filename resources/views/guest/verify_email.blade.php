@extends('guest.layouts.main')
@push('title')
    <title>Verify Email | LocalNepal</title>
@endpush
@push('links')
    <link rel="stylesheet" href="./assets/vendor/css/pages/page-auth.css" />
@endpush
@section('main-content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <div class="card">
                    <div class="card-body">
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <img src="{{ asset('assets/img/logo.png') }}" />
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Verify your Email ✉️</h4>
                        <p class="mb-4">A code has been sent to your email. Enter it below to verify your account</p>

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif

                        <form id="verify" class="mb-3" method="POST" action="{{ url('/verify-email') }}">
                            @csrf
                            @isset($user_id)
                                <input name="user_id" value="{{ $user_id }}" type="hidden">
                            @endisset
                            <div class="mb-3">
                                <label for="code" class="form-label">Verification Code</label>
                                <input type="number" class="form-control" id="code" name="otp"
                                    placeholder="Verification Code" required />
                            </div>

                            <button class="btn btn-primary d-grid w-100">Verify</button>
                            </span>
                        </form>

                        <p class="text-center">
                            <a href="{{ url('/') }}">
                                <span>Back to home</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
