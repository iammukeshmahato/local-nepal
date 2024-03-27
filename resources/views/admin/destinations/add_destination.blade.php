@extends('admin.layouts.main')
@push('title')
    <title>Add Destination - Admin | LocalNepal</title>
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush

@section('main-content')
    <form action="{{ url('/admin/destinations') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-12">
            <div class="card mb-4">
                <h5 class="card-header">Add Destination</h5>
                <div class="card-body row">
                    <div class="mb-3 col-md-6">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Bhaktapur Durbar Square" value="{{ old('title') }}" required />
                        @error('title')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="location" class="form-label">Location</label>
                        <input type="location" class="form-control" id="location" name="location" placeholder="Bhaktapur"
                            value="{{ old('location') }}" required />
                        @error('location')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="type" class="form-label">Type of Destination</label>
                        <input type="type" class="form-control" id="type" name="type"
                            placeholder="Religious Site" value="{{ old('type') }}" required />
                        @error('type')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="cover_image" class="form-label">Cover Image</label>
                        <input class="form-control" type="file" id="cover_image" name="cover_image" required />
                        @error('cover_image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                    <div class="mb-3 col-md-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-success" formnovalidate="formnovalidate">Submit
                            Data</button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@push('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description')).then(editor => {
                const description = editor.getData();
                console.log(description);
            })

            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
