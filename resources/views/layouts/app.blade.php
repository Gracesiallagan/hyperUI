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
                <span class="brand-mark">GT</span>
                <span class="brand-name">GandengTangan</span>
            </a>

            <nav class="nav">
                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('catalog') }}"
                   class="nav-link {{ request()->routeIs('catalog') || request()->routeIs('product.show') ? 'active' : '' }}">
                    Catalog
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    About
                </a>

                <a href="{{ route('contact') }}"
                   class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Contact
                </a>

                <a href="{{ route('how_to_buy') }}"
                   class="nav-link {{ request()->routeIs('how_to_buy') ? 'active' : '' }}">
                    How to Buy
                </a>
            </nav>

            <div class="header-actions">
                @auth
                    <a class="btn btn-dark" href="{{ route('admin.dashboard') }}">Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button class="btn btn-ghost" type="submit">Logout</button>
                    </form>
                @else
                    <a class="btn btn-dark" href="{{ route('login') }}">Admin Login</a>
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
            <div class="footer-copy">&copy; {{ date('Y') }} GandengTangan. All rights reserved.</div>
        </div>
    </footer>
</body>
</html>
