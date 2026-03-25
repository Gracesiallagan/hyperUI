@extends('layouts.auth')

@section('title', 'Login - GandengTangan')

@section('content')
<div class="container page">
    <div class="auth-wrap single">
        <div class="auth-card">
            <div class="auth-head">
                <div class="auth-brand">
                    <span class="auth-mark">◆</span>
                    <span>GandengTangan</span>
                </div>

                <h1 class="auth-title">Sign In</h1>
                <p class="auth-subtitle">
                    Masuk untuk mengelola karya, artis, dan produk di dashboard admin.
                </p>
            </div>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <div class="alert-title">Terjadi kesalahan:</div>
                    <ul class="alert-list">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="auth-form">
                @csrf

                <div class="field">
                    <label class="label" for="email">Email</label>
                    <input class="input" id="email" type="email" name="email"
                           value="{{ old('email') }}" required autofocus autocomplete="username">
                </div>

                <div class="field">
                    <label class="label" for="password">Password</label>
                    <input class="input" id="password" type="password" name="password"
                           required autocomplete="current-password">
                </div>

                <div class="row">
                    <label class="check">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="link" href="{{ route('password.request') }}">Lupa password?</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary auth-btn">Login</button>
            </form>

            {{-- kalau login khusus admin, bagian register bisa dihapus juga --}}
        </div>
    </div>
</div>
@endsection