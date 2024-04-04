<div class="card">
    <h5 class="card-header">Bookings</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>S.N</th>
                    @if (Auth::user()->role != 'tourist')
                        <th>Tourist</th>
                    @endif
                    @if (Auth::user()->role != 'guide')
                        <th>Guide</th>
                    @endif
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Method</th>
                    @if (Auth::user()->role == 'guide' || Auth::user()->role == 'tourist')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if ($bookings->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center">No Bookings Found</td>
                    </tr>
                @else
                    @foreach ($bookings as $item)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            @if (Auth::user()->role != 'tourist')
                                <td>
                                    <img src="{{ asset('storage/profiles/' . $item->tourist->user->avatar) }}"
                                        alt="Avatar" class="avatar rounded-circle">
                                    {{ $item->tourist->user->name }}
                                </td>
                            @endif
                            @if (Auth::user()->role != 'guide')
                                <td>
                                    <img src="{{ asset('storage/profiles/' . $item->guide->user->avatar) }}"
                                        alt="Avatar" class="avatar rounded-circle">
                                    {{ $item->guide->user->name }}
                                </td>
                            @endif
                            <td>{{ $item->start_date }}</td>
                            <td>{{ $item->end_date }}</td>
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
                            <td>{{ $item->transactions[0]['amount'] }}</td>
                            <td>
                                @if ($item->transactions[0]['payment_status'] == 'paid')
                                    <span
                                        class="badge bg-label-success me-1">{{ $item->transactions[0]['payment_status'] }}
                                    </span>
                                @else
                                    <span
                                        class="badge bg-label-warning me-1">{{ $item->transactions[0]['payment_status'] }}
                                    </span>
                                @endif

                            </td>
                            <td class="text-capitalize">{{ $item->transactions[0]['payment_method'] }}</td>
                            @if (Auth::user()->role == 'guide' || Auth::user()->role == 'tourist')
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);">
                                                <i class="bx bx-trash me-1"></i>View</a>
                                            @if ($item->status == 'pending')
                                                <a class="dropdown-item"
                                                    href="{{ url('/' . Auth::user()->role . '/booking/' . $item->id) . '/cancel' }}">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Cancel</a>
                                                @if (Auth::user()->role == 'guide')
                                                    <a class="dropdown-item"
                                                        href="{{ url('/guide/booking/' . $item->id . '/accept') }}">
                                                        <i class="bx bx-trash me-1"></i>Accept</a>
                                                @endif
                                                @if (Auth::user()->role == 'tourist' && $item->transactions[0]['payment_status'] == 'unpaid')
                                                    <a class="dropdown-item"
                                                        href="{{ url('/' . Auth::user()->role . '/payment/' . $item->id) }}">
                                                        <i class="bx bx-trash me-1"></i>
                                                        Pay</a>
                                                @endif
                                            @elseif(Auth::user()->role == 'tourist' && $item->transactions[0]['payment_status'] == 'unpaid')
                                                <a class="dropdown-item"
                                                    href="{{ url('/' . Auth::user()->role . '/payment/' . $item->id) }}">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Pay</a>
                                            @elseif($item->status == 'booked' && Auth::user()->role == 'guide')
                                                <a class="dropdown-item"
                                                    href="{{ url('/' . Auth::user()->role . '/booking/' . $item->id) . '/completed' }}">
                                                    <i class='menu-icon tf-icons bx bx-check me-1'></i>
                                                    Marked as Completed</a>
                                            @elseif($item->status == 'completed' && Auth::user()->role == 'tourist')
                                                <a class="dropdown-item"
                                                    href="{{ url('/guides/' . base64_encode($item->guide->id) . '#review') }}"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Rate Us</a>
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
