<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GandengTangan')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/public.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}">
                <span class="brand-mark">◆</span>
                <span class="brand-name">GandengTangan</span>
            </a>

            <nav class="nav">
                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('gallery') }}"
                   class="nav-link {{ request()->routeIs('gallery') || request()->routeIs('product.show') ? 'active' : '' }}">
                    Gallery
                </a>

                {{-- Anda belum punya route "Our Artists" versi public.
                     Kalau nanti ada, tinggal ganti href ke route tsb. --}}
                <a href="{{ route('artists') }}"
                   class="nav-link">
                    Our Artists
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    About Us
                </a>
            </nav>

            <div class="header-actions">
                <div class="search">
                    <span class="search-icon">🔎</span>
                    <input class="search-input" type="text" placeholder="Search artworks...">
                </div>

                <button class="icon-btn" type="button" aria-label="Cart">🛒</button>

                @auth
                    <a class="btn btn-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button class="btn btn-ghost" type="submit">Logout</button>
                    </form>
                @else
                    <a class="btn btn-dark" href="{{ route('login') }}">Sign In</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-inner">
            <div class="footer-brand">GandengTangan</div>
            <div class="footer-copy">© {{ date('Y') }} GandengTangan. All rights reserved.</div>
        </div>
    </footer>
</body>
</html>