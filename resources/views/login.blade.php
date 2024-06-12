@extends('template')

@section('body')
    <div class="row">
        <div class="col-md-6 offset-md-3">

            <div class="card">
                <div class="card-header fw-bold text-uppercase">Sign In</div>
                <div class="card-body">
                    @error('message')
                        <div class="alert alert-danger small py-3">
                            {{ $message }}
                        </div>
                    @enderror
                    @if(session('message'))
                        <div class="alert alert-success small py-3">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('auth.login.process') }}">
                        @csrf
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
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="small fw-semibold text-muted">
                                I dont have any account 😢! Make one <a class="text-decoration-none" href="{{ route('auth.register') }}">here</a>.
                            </div>
                            <button class="btn btn-primary btn-md">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection



