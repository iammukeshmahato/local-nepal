@extends('admin.layouts.main')
@push('title')
    <title>Verify Guide - Admin | LocalNepal</title>
@endpush
@section('main-content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details</h5>
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/profiles/' . $guide->user->avatar) }}" alt="user-avatar"
                                class="d-block rounded" height="100%" width="100%" id="uploadedAvatar" />
                            <p class="my-2 text-center">Profile Picture</p>
                        </div>
                        <div class="col-md-4">
                            <img src="{{ asset('storage/guides/id/' . $guide->national_id) }}" alt="user-avatar"
                                class="d-block rounded" height="100%" width="100%" id="uploadedAvatar" />
                            <p class="my-2 text-center">National Id</p>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $guide->user->name }}" placeholder="John Doe" disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $guide->user->email }}" placeholder="name@example.com" disabled />
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone"
                                name="phone"value="{{ $guide->phone }}" placeholder="9800000000" disabled />
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                value="{{ $guide->user->dob }}" placeholder="2001-01-01" disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $guide->address }}" placeholder="Kathmandu" disabled />
                        </div>

                        @if ($guide->status == 'pending')
                            <div class="mb-3 col-md-12 d-flex justify-content-end">
                                <a class="btn btn-success text-white"
                                    href="{{ url('/admin/guide/' . $guide->id . '/verify') }}">Mark as Verified</a>
                            </div>
                        @endif
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    @endsection
