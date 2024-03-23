@extends('admin.layouts.main')
@push('title')
    <title>Add Guide - Admin | LocalNepal</title>
@endpush

@section('main-content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ url('/admin/guide/' . $guide->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Update Guide</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $guide->user->name }}" placeholder="John Doe" required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $guide->user->email }}" placeholder="name@example.com" required disabled />
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone"value="{{ $guide->phone }}"
                            placeholder="9800000000" required />
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob"
                            value="{{ $guide->user->dob }}" placeholder="2001-01-01" required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address"
                            value="{{ $guide->address }}" placeholder="Kathmandu" required />
                    </div>

                    <div class="mb-3 col-md-12 d-flex justify-content-end">
                        <input class="btn btn-success" type="submit" value="Update Guide">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
