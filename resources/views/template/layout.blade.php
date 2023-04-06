<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <script
        src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="
        crossorigin="anonymous"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/935ca818bb.js" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('js/app.js') }}" crossorigin="anonymous"></script>

</head>
<body>

<div class="container">
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('index') ? "active" : "" }}" href="{{ route('index') }}">Active</a>
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
                <div class="input-group me-2">
                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                    <input name="username" class="form-control form-control-sm" type="text" placeholder="Username" aria-label="Username">
                </div>
                <div class="input-group me-2">
                    <span class="input-group-text"><i class="fa-solid fa-key"></i></span>
                    <input name="password" class="form-control form-control-sm" type="password" placeholder="Password" aria-label="Password">
                </div>
                <button class="btn btn-primary border" type="submit">Login</button>

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
        <div class="alert alert-info alert-dismissible">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
<div class="container p-5">

    @yield('content')
</div>
</body>
</html>
