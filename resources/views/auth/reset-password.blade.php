@extends('layouts.auth')

@section('title', 'Reset Password - GandengTangan')

@section('content')
<div class="container page">
    <div class="auth-wrap single">
        <div class="auth-card">
            <div class="auth-head">
                <div class="auth-brand"><span class="auth-mark">GT</span><span>GandengTangan</span></div>
                <h1 class="auth-title">Reset Password</h1>
                <p class="auth-subtitle">Buat password admin baru yang aman dan mudah Anda ingat.</p>
            </div>

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

            <form method="POST" action="{{ route('password.store') }}" class="auth-form" data-confirm-submit data-confirm-title="Reset Password?" data-confirm-message="Password admin akan diganti dengan password baru.">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="field">
                    <label class="label" for="email">Email Admin</label>
                    <input id="email" class="input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                </div>

                <div class="field">
                    <label class="label" for="password">Password Baru</label>
                    <input id="password" class="input" type="password" name="password" required autocomplete="new-password">
                </div>

                <div class="field">
                    <label class="label" for="password_confirmation">Konfirmasi Password</label>
                    <input id="password_confirmation" class="input" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn btn-primary auth-btn">Reset Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
