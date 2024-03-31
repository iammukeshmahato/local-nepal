@extends('admin.layouts.main')
@push('title')
    <title>Add Language - Admin | LocalNepal</title>
@endpush

@section('main-content')
    <div class="col-md-6">
        <div class="card mb-4">
            <h5 class="card-header">Languages</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if (isset($languages) && count($languages) == 0)
                            <tr>
                                <td colspan="3" class="text-center">No languages found</td>
                            </tr>
                        @else
                            @foreach ($languages as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <form action="{{ url('/admin/language/' . $item->id) }}" method="post">
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
    </div>
@endsection
