@extends('layouts.auth')

@section('title', 'Lupa Password - GandengTangan')

@section('content')
<div class="container page">
    <div class="auth-wrap single">
        <div class="auth-card">
            <div class="auth-head">
                <div class="auth-brand"><span class="auth-mark">GT</span><span>GandengTangan</span></div>
                <h1 class="auth-title">Lupa Password</h1>
                <p class="auth-subtitle">Masukkan email admin. Link reset password akan dikirim ke email sesuai konfigurasi mail aplikasi.</p>
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

            <form method="POST" action="{{ route('password.email') }}" class="auth-form" data-confirm-submit data-confirm-title="Kirim Link Reset?" data-confirm-message="Sistem akan mengirim link reset password ke email yang Anda masukkan.">
                @csrf
                <div class="field">
                    <label class="label" for="email">Email Admin</label>
                    <input id="email" class="input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="admin@gandengtangan.id">
                </div>
                <button type="submit" class="btn btn-primary auth-btn">Kirim Link Reset</button>
                <a class="btn btn-ghost auth-btn" href="{{ route('login') }}">Kembali ke Login</a>
            </form>
        </div>
    </div>
</div>
@endsection
