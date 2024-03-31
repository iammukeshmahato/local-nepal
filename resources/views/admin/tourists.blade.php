@extends('admin.layouts.main')
@push('title')
    <title>Tourists - Admin | LocalNepal</title>
@endpush
@section('main-content')
    <div class="card">
        <h5 class="card-header">Tourists</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Nationality</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($tourists->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center">No Tourist Found</td>
                        </tr>
                    @else
                        @foreach ($tourists as $tourist)
                            <tr>
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>{{ $tourist->user->name }}</td>
                                <td>{{ $tourist->user->email }}</td>
                                <td>{{ $tourist->phone }}</td>
                                <td>{{ $tourist->nationality }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ url('/admin/tourist/' . $tourist->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                View</a>
                                            <form action="{{ url('/admin/tourist/' . $tourist->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item" href="javascript:void(0);"
                                                    onclick="return confirm('Are you sure want to delete?')"><i
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
    <div class="d-flex justify-content-center mt-4">{{ $tourists->links() }} </div>
@endsection
