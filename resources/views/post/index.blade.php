@extends('template')

@section('body')
    <div class="mb-4 d-flex justify-content-between">
        <h4>Post</h4>
        <a href="{{ route('post.create') }}" class="btn btn-primary btn-md">
            + Make New
        </a>
    </div>
    @error('message')
        <div class="alert alert-danger small py-3 mb-4">
            {{ $message }}
        </div>
    @enderror
    @if(session('message'))
        <div class="alert alert-success small py-3 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-hover table-striped border">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>
                        <td>
                            {{ $post->title }}
                        </td>
                        <td>
                            <img src="{{ asset($post->image) }}" alt="Post Image" style="width: 100px;">
                        </td>
                        <td>
                            <a href="{{ route('post.edit', [ 'post' => $post->id ]) }}" class="btn btn-primary btn-sm">
                                Edit
                            </a>
                            <a href="{{ route('post.destroy', [ 'post' => $post->id ]) }}" class="btn btn-danger btn-sm" onclick="return deleteConfirm()">
                                Delete
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">No post found!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection

@section('script')
    <script>
        function deleteConfirm() {
            let approve = confirm('Are you sure to delete this post?');
            return approve;
        }
    </script>
@endsection




