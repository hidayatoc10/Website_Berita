<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('web.index') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            @auth
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('post.index') }}">Post</a>
                        <a class="nav-link" href="{{ route('account.index') }}">Account</a>
                        <a class="nav-link" href="{{ route('auth.logout') }}">Logout</a>
                    </div>
                </div>
            @endauth

            @guest
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="{{ route('auth.login') }}">Login</a>
                        <a class="nav-link" href="{{ route('auth.register') }}">Register</a>
                    </div>
                </div>
            @endguest
        </div>
    </nav>
    <div class="container py-5">
        @yield('body')
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
@yield('script')
</html>



