@extends('template')

@section('body')
    <div class="mb-4 card">
        <div class="card-body small">
            <a class="text-decoration-none" href="{{ route('web.index') }}">Home</a> / <span class="text-muted">{{ $post->title }}</span>
        </div>
    </div>
    <h3>{{ $post->title }}</h3>
    <div class="mb-4 text-muted">
        Post by <span class="fw-semibold">{{ $post->user->name }}</span>
        on {{ $post->created_at->format('d F Y') }}
    </div>
    <img src="{{ asset($post->image) }}" alt="Post Image" class="mb-4 d-block m-auto w-100 rounded">
    {{ $post->content }}
@endsection



