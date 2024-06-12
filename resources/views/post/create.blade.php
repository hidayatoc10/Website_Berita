@extends('template')

@section('body')
    <div class="mb-4 d-flex justify-content-between">
        <h4>Create Post</h4>
    </div>
    @error('message')
        <div class="alert alert-danger small py-3 mb-4">
            {{ $message }}
        </div>
    @enderror
    <form method="POST" enctype="multipart/form-data" action="{{ route('post.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold" for="title">Title</label>
            <input class="form-control" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}" />
            <small class="text-danger">{{ $errors->first('title') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image" />
            <small class="text-danger">{{ $errors->first('image') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="content">Content</label>
            <textarea name="content" id="content" class="form-control" cols="30" rows="10" placeholder="Enter content">{{ old('content') }}</textarea>
            <small class="text-danger">{{ $errors->first('content') }}</small>
        </div>
        <div class="d-flex justify-content-end align-items-center gap-2">
            <button class="btn btn-primary btn-md">
                Save
            </button>
            <a class="btn btn-secondary btn-md" href="{{ route('post.index') }}">
                Cancel
            </a>
        </div>
    </form>
@endsection



