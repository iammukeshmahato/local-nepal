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

                            @error('phone')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
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

    @if (isset($profile_completed) && $profile_completed)
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4 position-relative">
                    <h5 class="card-header">Spent This Months</h5>
                    <div class="card-body row">
                        <div class="mb-3">
                            <h1>${{ $total_spent_this_month }}</h1>
                        </div>
                    </div>
                    <a href="{{ url('/admin/destinations/') }}" class="stretched-link"></a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 position-relative">
                    <h5 class="card-header">Destinations Travelled</h5>
                    <div class="card-body row">
                        <div class="mb-3 col-md-6">
                            <h1>{{ $destination_travelled }}</h1>
                        </div>
                    </div>
                    <a href="{{ url('/admin/guide/') }}" class="stretched-link"></a>
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
                    <a href="{{ url('/admin/tourist/') }}" class="stretched-link"></a>
                </div>
            </div>

            {{-- New Destinations --}}
            <div class="col-lg-12 col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">New Destinations</h5>
                    <div class="card-body row">
                        <table class="table">
                            <thead>
                                <th>SN</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Location</th>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($new_destinations as $item)
                                    <tr class="position-relative">
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <img class="avatar"
                                                src="{{ asset('storage/destinations/' . $item->cover_image) }}"
                                                alt="..." style="width:4rem; height:4rem;"></td>
                                        <td>{{ $item->title }}
                                            <a href="{{ url('/admin/destinations/' . $item->id) }}"
                                                class="stretched-link"></a>
                                        </td>
                                        <td>
                                            {{ $item->location }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
    @endif
@endsection
