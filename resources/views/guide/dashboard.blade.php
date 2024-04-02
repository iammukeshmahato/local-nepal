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

    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Transactions This Months</h5>
                <div class="card-body row">
                    <div class="mb-3">
                        <h1>${{ $total_transactions_this_month }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Total Tourist Served This Month</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <h1>{{ $total_tourists_served_this_month }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Total Reviews</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <h1>{{ $total_reviews }}</h1>
                    </div>
                </div>
                <a href="{{ url('/guide/reviews/') }}" class="stretched-link"></a>
            </div>
        </div>

        {{-- Recent Bookings --}}
        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Recent Bookings</h5>
                <div class="card-body row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Guide</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Locaiton</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($recent_bookings->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No Bookings Found</td>
                                </tr>
                            @else
                                @foreach ($recent_bookings as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/profiles/' . $item->guide->user->avatar) }}"
                                                alt="Avatar" class="avatar rounded-circle">
                                            {{ $item->guide->user->name }}
                                        </td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->guide->location }}</td>
                                        <td>${{ $item->transactions[0]['amount'] }}</td>
                                        <td>
                                            @if ($item->status == 'pending')
                                                <span class="badge bg-label-warning me-1">{{ $item->status }}</span>
                                            @elseif($item->status == 'booked')
                                                <span class="badge bg-label-success me-1">{{ $item->status }}</span>
                                            @elseif($item->status == 'completed')
                                                <span class="badge bg-label-info me-1">{{ $item->status }}</span>
                                            @elseif($item->status == 'cancelled')
                                                <span class="badge bg-label-danger me-1">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Recent Guide's Review --}}
        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Recent Guide Reviews</h5>
                <div class="card-body row">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'tourist')
                                    <th>Guide</th>
                                @endif
                                <th>Rating</th>
                                <th>Review</th>
                                <th>Date</th>
                                @if (Auth::user()->role == 'tourist')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @if ($recent_reviews->isEmpty())
                                <tr>
                                    <td colspan="7" class="text-center">No reviews Found</td>
                                </tr>
                            @else
                                @foreach ($recent_reviews as $item)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'tourist')
                                            <td>
                                                <img src="{{ asset('storage/profiles/' . $item->guide->user->avatar) }}"
                                                    alt="Avatar" class="avatar rounded-circle">
                                                {{ $item->guide->user->name }}
                                            </td>
                                        @endif
                                        <td>{{ $item->rating }}</td>
                                        <td>{{ $item->review }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        @if (Auth::user()->role == 'tourist')
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                        data-bs-toggle="dropdown">
                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @if ($item->tourist->user->id == Auth::user()->id)
                                                            <a class="dropdown-item" href=""><i
                                                                    class="bx bx-trash me-1"></i>
                                                                Delete</a>
                                                        @elseif($item->status == 'booked' && Auth::user()->role == 'guide')
                                                            <a class="dropdown-item"
                                                                href="{{ url('/' . Auth::user()->role . '/booking/' . $item->id) . '/completed' }}"><i
                                                                    class="bx bx-trash me-1"></i>
                                                                Marked as Completed</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
