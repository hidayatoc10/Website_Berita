@extends('template')

@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-header fw-bold text-uppercase">Register</div>
                <div class="card-body">
                    @error('message')
                        <div class="alert alert-danger small py-3">
                            {{ $message }}
                        </div>
                    @enderror
                    <form method="POST" action="{{ route('auth.register.process') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="name">Name</label>
                            <input class="form-control" id="name" name="name" placeholder="Enter name" value="{{ old('name') }}" />
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold" for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}" />
                            <small class="text-danger">{{ $errors->first('email') }}</small>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small fw-semibold text-muted">
                                Back to <a class="text-decoration-none" href="{{ route('auth.login') }}">Login</a>!
                            </div>
                            <button class="btn btn-primary btn-md">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection




