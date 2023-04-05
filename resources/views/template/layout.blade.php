<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <script
        src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? "active" : "" }}" href="{{ route('index') }}">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            @if(empty(session('username', '')))
            <form method="post" action="{{ route('auth.login') }}" class="d-flex">
                @csrf

                <input name="username" class="form-control me-2" type="text" placeholder="Username" aria-label="Username">
                <input name="password" class="form-control me-2" type="password" placeholder="Password" aria-label="Password">
                <button class="btn btn-primary" type="submit">Login</button>

            </form>
            @else
                <div class="d-flex align-items-center">
                <div class="font-monospace text-light p-2">Vítejte {{session('username')}}</div>
                <a href="{{ route('auth.logout') }}" class="btn btn-primary">Odhlásit</a>
                </div>
            @endif
        </div>
    </nav>

</div>
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
</div>
<div class="container p-5">

    @yield('content')
</div>
</body>
</html>
