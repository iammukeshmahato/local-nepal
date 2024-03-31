@extends('admin.layouts.main')
@section('main-content')
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Total Destinations</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <h1>{{ $total_destinations }}</h1>
                    </div>
                </div>
                <a href="{{ url('/admin/destinations/') }}" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Total Guides</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <h1>{{ $total_guides }}</h1>
                    </div>
                </div>
                <a href="{{ url('/admin/guide/') }}" class="stretched-link"></a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4 position-relative">
                <h5 class="card-header">Total Tourists</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <h1>{{ $total_tourists }}</h1>
                    </div>
                </div>
                <a href="{{ url('/admin/tourist/') }}" class="stretched-link"></a>
            </div>
        </div>


        <div class="col-lg-6 col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">New Destinations</h5>
                <div class="card-body row">
                    <table class="table">
                        <thead>
                            <th>SN</th>
                            <th>Image</th>
                            <th>Title</th>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($new_destinations as $item)
                                <tr class="position-relative">
                                    <td>{{ $loop->iteration }}</td>
                                    <td> <img class="avatar" src="{{ asset('storage/destinations/' . $item->cover_image) }}"
                                            alt="..." style="width:4rem; height:4rem;"></td>
                                    <td>{{ $item->title }}
                                        <a href="{{ url('/admin/destinations/' . $item->id) }}" class="stretched-link"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">New Guides</h5>
                <div class="card-body row">
                    <div>
                        <table class="table">
                            <thead>
                                <th>SN</th>
                                <th>Profile</th>
                                <th>Name</th>
                                <th>Location</th>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($new_guides as $item)
                                    <tr class="position-relative">
                                        <td>{{ $loop->iteration }}</td>
                                        <td> <img class="avatar"
                                                src="{{ asset('storage/profiles/' . $item->user->avatar) }}" alt="..."
                                                style="width:4rem; height:4rem;"></td>
                                        <td>{{ $item->user->name }}
                                            <a href="{{ url('/admin/guide/' . $item->id) }}" class="stretched-link"></a>
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
        </div>
    @endsection
