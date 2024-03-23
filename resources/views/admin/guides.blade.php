@extends('admin.layouts.main')
@push('title')
    <title>Guides - Admin | LocalNepal</title>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Guides</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($guides->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No Guides Found</td>
                        </tr>
                    @else
                        @foreach ($guides as $guide)
                            {{-- @dd($guide); --}}
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $guide->user->name }}</td>
                                <td>{{ $guide->user->email }}</td>
                                <td>{{ $guide->phone }}</td>
                                <td>{{ $guide->address }}</td>
                                <td>
                                    @if ($guide->status == 'pending' || $guide->status == 'deactive')
                                        <span class="badge bg-label-warning me-1">{{ $guide->status }}</span>
                                    @elseif ($guide->status == 'active')
                                        <span class="badge bg-label-success me-1">{{ $guide->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                View</a>
                                            @if ($guide->status == 'active')
                                                <a class="dropdown-item"
                                                    href="{{ url('admin/guide/' . $guide->id . '/deactive') }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Deactive</a>
                                            @else
                                                <a class="dropdown-item"
                                                    href="{{ url('admin/guide/' . $guide->id . '/active') }}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Active</a>
                                            @endif
                                            <a class="dropdown-item"
                                                href="{{ url('/admin/guide/' . $guide->id . '/edit') }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>

                                            <form action="{{ url('/admin/guide/' . $guide->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" href="javascript:void(0);"
                                                    onclick="confirm('Are you sure want to delete?')"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                    {{-- <tr>
                        <td>
                            1
                        </td>
                        <td>Albert Cook</td>
                        <td>example@gmail.com</td>
                        <td>9800000000</td>
                        <td>Kathmandu, Nepal</td>
                        <td><span class="badge bg-label-warning me-1">Not Listed</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        View</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
