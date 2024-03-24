@extends('tourist.layouts.main')
@push('title')
    <title>Tourist Dashboard | LocalNepal</title>
@endpush
@section('main-content')
    @if (isset($profile_completed) && !$profile_completed)
        <form action="{{ url('/tourist/update-profile') }}" method="post" enctype="multipart/form-data">
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
                            <label for="nationality" class="form-label">nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality"
                                placeholder="Nepal" required />
                        </div>

                        <div class="mb-3 col-md-12 d-flex justify-content-end">
                            <input class="btn btn-success" type="submit" value="Complete Profile">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endif
@endsection
