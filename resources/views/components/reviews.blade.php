@extends(Auth::user()->role . '.layouts.main')
@push('title')
    <title>reviews - {{ Str::upper(Auth::user()->role) }} | LocalNepal</title>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Reviews</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Tourist</th>
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
                    @if ($reviews->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No reviews Found</td>
                        </tr>
                    @else
                        @foreach ($reviews as $item)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    <img src="{{ asset('storage/profiles/' . $item->tourist->user->avatar) }}" alt="Avatar"
                                        class="avatar rounded-circle">
                                    {{ $item->tourist->user->name }}
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
                                                    <a class="dropdown-item" href=""><i class="bx bx-trash me-1"></i>
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
@endsection
