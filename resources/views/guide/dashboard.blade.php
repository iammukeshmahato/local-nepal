@extends('guide.layouts.main')
@push('title')
    <title>Guide Dashboard | LocalNepal</title>
@endpush
@section('main-content')
    @if (isset($profile_completed) && !$profile_completed)
        <form action="{{ url('/guide/update-profile') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Complete Your Profile</h5>
                    <div class="card-body row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $user->name }}"
                                name="name" placeholder="John Doe" required disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                name="email" placeholder="name@example.com" required disabled />
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone"
                                placeholder="9800000000" required />
                        </div>

                        <div class="mb-3 col-md-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" value="{{ $user->dob }}"
                                name="dob" placeholder="2001-01-01" required disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Kathmandu"
                                required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="national_id" class="form-label">National ID</label>
                            <input class="form-control" type="file" id="national_id" name="national_id" required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Location of Serve</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Kathmandu"
                                required />
                        </div>

                        <div class="mb-3 col-md-12 d-flex justify-content-end">
                            <input class="btn btn-success" type="submit" value="Complete Profile">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif

    @if (isset($profile_completed) && $profile_completed && $guide->status != 'active')
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">
                    @if ($guide->status == 'pending')
                        Your profile is completed and waiting for admin approval
                    @elseif($guide->status == 'deactive')
                        Your account is deactivated by admin. Please contact admin for more information.
                    @endif

                </h5>
                <span class="card-header">Status:

                    @if ($guide->status == 'pending' || $guide->status == 'deactive')
                        <span class="badge bg-label-warning me-1">{{ $guide->status }}</span>
                    @endif
                </span>
            </div>

        </div>
    @endif
@endsection
