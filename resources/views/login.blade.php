@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
    @parent
    <h1>Přihlášení</h1>

    <div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action="{{ route('auth.login') }}">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Uživatelské jméno</label>
                <input name="username" type="text" class="form-control" id="username" aria-describedby="username-label">
                <div id="username-label" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
