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
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" placeholder="John Doe" disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" placeholder="name@example.com" disabled />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="number" class="form-control" id="phone"
                                name="phone"value="{{ $user->phone }}" placeholder="9800000000"
                                value="{{ old('phone') }}" required />
                            @error('phone')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob"
                                value="{{ $user->dob }}" placeholder="2001-01-01" required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user->address }}" placeholder="Kathmandu" required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="languages" class="form-label">Language</label>
                            <select name="languages[]" class="form-select" multiple>
                                @foreach ($languages as $language)
                                    <option value="{{ $language->id }}">
                                        {{ $language->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="location" class="form-label">Serving Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $user->location }}" placeholder="Bhaktapur" required />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="rate" class="form-label">Rate per hour</label>
                            <input type="number" class="form-control" id="rate" name="rate"
                                value="{{ $user->rate }}" placeholder="$5" required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="national_id" class="form-label">National ID</label>
                            <input class="form-control" type="file" id="national_id" name="national_id" required />
                        </div>

                        <div class="mb-3 col-md-6">
                            <label for="about" class="form-label">About</label>
                            <textarea class="form-control" id="about" name="about" placeholder="Describe yourself" required></textarea>
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
