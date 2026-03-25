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
            <a class="brand" href="/">
                <span class="brand-mark">◆</span>
                <span class="brand-name">GandengTangan</span>
            </a>

            <nav class="nav">
                <a href="#" class="nav-link active">Home</a>
                <a href="#" class="nav-link">Gallery</a>
                <a href="#" class="nav-link">Our Artists</a>
                <a href="#" class="nav-link">About Us</a>
            </nav>

            <div class="header-actions">
                <div class="search">
                    <span class="search-icon">🔎</span>
                    <input class="search-input" type="text" placeholder="Search artworks...">
                </div>

                <button class="icon-btn" type="button" aria-label="Cart">🛒</button>
                <a class="btn btn-dark" href="{{ route('login') }}">Sign In</a>
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