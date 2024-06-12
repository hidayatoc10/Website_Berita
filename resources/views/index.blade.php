@extends('template')

@section('body')
    <div class="row">
        @forelse ($posts as $post)
            <div class="col-4">
                <div class="card overflow-hidden mb-4">
                    <img src="{{ asset($post->image) }}" alt="Post Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('web.page', [ 'post' => $post->slug ]) }}" class="btn btn-primary">View Post</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-dark text-center">
                No post found
            </div>
        @endforelse
    </div>
@endsection



