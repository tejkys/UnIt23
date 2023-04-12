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
<body class="bg-light">


    <nav class="navbar navbar-expand-sm navbar-dark bg-white">
        <div class="container-fluid">
            <ul class="navbar-nav">

            </ul>
                <div class="font-monospace text-dark p-2">&lt? echo("UPCE (J)ELITA); </div>
                </div>


    </nav>


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

