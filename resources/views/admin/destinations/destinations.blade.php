@extends('admin.layouts.main')
@push('title')
    <title>Destinations - Admin | LocalNepal</title>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Destinations</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Cover Image</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($destinations->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No Destinations Found</td>
                        </tr>
                    @else
                        @foreach ($destinations as $item)
                            {{-- @dd($item); --}}
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $item->title }}</td>
                                <td><img class="avatar" src="{{ asset('storage/destinations/' . $item->cover_image) }}"
                                        alt=""></td>
                                <td>{{ $item->location }}</td>
                                <td>{{ $item->type }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ url('/admin/destination/' . $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                View</a>

                                            <a class="dropdown-item"
                                                href="{{ url('/admin/destination/' . $item->id . '/edit') }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>

                                            <form action="{{ url('/admin/destination/' . $item->id) }}" method="post">
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
                </tbody>
            </table>
        </div>
    </div>
@endsection
