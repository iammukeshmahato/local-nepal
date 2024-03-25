@extends('guest.layouts.main')
@push('title')
    <title>Reset Password | LocalNepal</title>
@endpush
@section('main-content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{ url('/') }}" class="app-brand-link gap-2">
                                <img src="{{ asset('assets/img/logo.png') }}" alt="Local Nepal">
                            </a>
                        </div>
                        <!-- /Logo -->

                        @if (session()->has('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session()->get('error') }}
                            </div>
                        @endif
                        <h4 class="mb-2">Reset Password 🔒</h4>
                        <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework"
                            action="{{ url('/reset-password/new') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email or username" value="{{ $email }}" />
                            </div>

                            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="password">New Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Enter New Password" aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle fv-plugins-icon-container">
                                <label class="form-label" for="confirm-password">Confirm Password</label>
                                <div class="input-group input-group-merge has-validation">
                                    <input type="password" id="confirm-password" class="form-control"
                                        name="password_confirmation" placeholder="Enter Confirm Password"
                                        aria-describedby="password" required>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3">
                                Set new password
                            </button>
                            <div class="text-center">
                                <a href="{{ url('/login') }}">
                                    <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                    Back to login
                                </a>
                            </div>
                            <input type="hidden">
                        </form>
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>
@endsection
