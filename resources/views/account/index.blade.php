@extends('template')

@section('body')
    <div class="mb-4 d-flex justify-content-between">
        <h4>Account</h4>
    </div>
    @if(session('message'))
        <div class="alert alert-success small py-3 mb-4">
            {{ session('message') }}
        </div>
    @endif
    <div class="mb-3">
        <label class="form-label fw-semibold" for="name">Name</label>
        <input class="form-control" id="name" name="name" placeholder="Enter name" value="{{ $user->name }}" readonly />
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ $user->email }}" readonly />
    </div>
    <div class="mb-3">
        <label class="form-label fw-semibold" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="xxxxxxxxxx" readonly />
    </div>
    <div class="d-flex justify-content-end align-items-center gap-2">
        <a class="btn btn-primary btn-md" href="{{ route('account.edit') }}">Change Account</a>
    </div>
@endsection



