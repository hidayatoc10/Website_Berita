@extends('template')

@section('body')
    <div class="mb-4 d-flex justify-content-between">
        <h4>Edit Account</h4>
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
    <form method="POST" action="{{ route('account.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label fw-semibold" for="name">Name</label>
            <input class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name', $user->name) }}" />
            <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $user->email }}" readonly />
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" />
            <small class="text-danger">{{ $errors->first('password') }}</small>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold" for="password_confirmation">Password Confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter password confirmation" />
        </div>
        <div class="d-flex justify-content-end align-items-center gap-2">
            <button class="btn btn-primary btn-md">
                Save
            </button>
        </div>
    </form>
@endsection



