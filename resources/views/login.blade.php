@extends('template.layout')

@section('title', 'Vítejte')

@section('content')
    @parent


    <div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif


    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <form method="post" action="{{ route('auth.login') }}" class="p-5 bg-white rounded-3" style="width: 400px;">
            @csrf
            <h2 class="text-center mb-4">Přihlášení</h2>
            <div class="form-floating mb-3">
                <input name="username" class="form-control form-control-sm" type="text" placeholder="Username" aria-label="Username">
                <label for="username">Uživatelské jméno</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control form-control-sm" id="password" placeholder="Password">
                <label for="password">Heslo</label>
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Přihlásit se</button>
            </div>
        </form>
    </div>
@endsection
