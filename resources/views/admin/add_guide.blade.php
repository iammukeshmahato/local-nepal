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
    <form action="{{ url('/admin/guide') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Add Guide</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="John Doe"
                            required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="name@example.com" required />
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" class="form-control" id="phone" name="phone" value="9812345678" placeholder="9800000000"
                            required />
                    </div>

                    <div class="mb-3 col-md-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" name="dob" placeholder="2001-01-01"
                            required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Kathmandu"
                            required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="avatar" class="form-label">Profile Picture</label>
                        <input class="form-control" type="file" id="avatar" name="avatar" required />
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="national_id" class="form-label">National ID</label>
                        <input class="form-control" type="file" id="national_id" name="national_id" required />
                    </div>

                    <div class="mb-3 col-md-12 d-flex justify-content-end">
                        <input class="btn btn-success" type="submit" value="Add Guide">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
