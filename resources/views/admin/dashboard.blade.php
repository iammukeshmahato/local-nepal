@extends('admin.layouts.main')
@section('main-content')
    {{-- languages --}}
    <div class="row">

        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Add Language</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <label for="Language" class="form-label">Langugae</label>
                        <input type="text" class="form-control" id="Language" placeholder="English" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Languages I know</h5>
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
                            <tr>
                                <td>1</td>
                                <td>Albert Cook</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Albert Cook</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                    class="bx bx-trash me-1"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- add guide --}}
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header">Add Guide</h5>
            <div class="card-body row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" placeholder="John Doe" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="name@example.com" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="number" class="form-control" id="phone" placeholder="9800000000" />
                </div>

                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Kathmandu" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="profile" class="form-label">Profile Picture</label>
                    <input class="form-control" type="file" id="profile" />
                </div>
                <div class="mb-3 col-md-6">
                    <label for="national_id" class="form-label">National ID</label>
                    <input class="form-control" type="file" id="national_id" />
                </div>
            </div>
        </div>
    </div>

    <!-- view guide -->
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
                    <tr>
                        <td>
                            1
                        </td>
                        <td>Albert Cook</td>
                        <td>example@gmail.com</td>
                        <td>9800000000</td>
                        <td>Kathmandu, Nepal</td>
                        <td><span class="badge bg-label-success me-1">Active</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        View</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt me-1"></i>
                                        Edit</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
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
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> View</a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-trash me-1"></i> Delete</a>
                                    </div>
                                </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- bookings --}}
    <div class="card mt-4">
        <h5 class="card-header">My Booking</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Pickup Location</th>
                        <th>Date & Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td>
                            1
                        </td>
                        <td>Albert Cook</td>
                        <td>example@gmail.com</td>
                        <td>9800000000</td>
                        <td>Kathmandu, Nepal</td>
                        <td>2022-11-11 10:15</td>
                        <td><span class="badge bg-label-success me-1">Booked</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Accept</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Decline</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>Albert Cook</td>
                        <td>example@gmail.com</td>
                        <td>9800000000</td>
                        <td>Kathmandu, Nepal</td>
                        <td>2022-11-11 10:15</td>
                        <td><span class="badge bg-label-warning me-1">Pending</span></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                    data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0);"><i
                                            class="bx bx-edit-alt me-1"></i> Accept</a>
                                    <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                        Decline</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
