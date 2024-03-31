@extends('admin.layouts.main')
@push('title')
    <title>Add Language - Admin | LocalNepal</title>
@endpush

@section('main-content')
    <form action="{{ url('/admin/language') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-6">
            <div class="card mb-4">
                <h5 class="card-header">Add Language</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <label for="Language" class="form-label">Langugae</label>
                        <input type="text" name="name" class="form-control" id="Language" placeholder="English" />
                    </div>
                    <div class="mb-3 col-md-2">
                        <div class="form-label">&nbsp;</div>
                        <input class="btn btn-success mx-auto" type="submit" value="Add Language">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
