<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'GandengTangan')</title>

    @php($siteSetting = \Illuminate\Support\Facades\Schema::hasTable('settings') ? \App\Models\Setting::query()->first() : null)
    @if(!empty($siteSetting?->favicon))
        <link rel="icon" href="{{ route('media.show', ['path' => preg_replace('#^(storage/|public/)#', '', ltrim($siteSetting->favicon, '/'))]) }}">
    @endif
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/public.css') }}">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a class="brand" href="{{ route('home') }}">
                @if(!empty($siteSetting?->logo))
                    <img class="brand-logo" src="{{ route('media.show', ['path' => preg_replace('#^(storage/|public/)#', '', ltrim($siteSetting->logo, '/'))]) }}" alt="Logo GandengTangan">
                @else
                    <span class="brand-mark">GT</span>
                @endif
                <span class="brand-name">{{ $siteSetting->site_name ?? 'GandengTangan' }}</span>
            </a>

            <button class="mobile-menu-toggle" type="button" aria-label="Buka menu" aria-expanded="false" aria-controls="mainNav">☰</button>

            <nav class="nav" id="mainNav">
                <a href="{{ route('home') }}"
                   class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    Home
                </a>

                <a href="{{ route('catalog') }}"
                   class="nav-link {{ request()->routeIs('catalog') || request()->routeIs('product.show') ? 'active' : '' }}">
                    Katalog
                </a>

                <a href="{{ route('about') }}"
                   class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    Tentang
                </a>

                <a href="{{ route('contact') }}"
                   class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Kontak
                </a>

                <a href="{{ route('how_to_buy') }}"
                   class="nav-link {{ request()->routeIs('how_to_buy') ? 'active' : '' }}">
                    Cara Membeli
                </a>

                <a href="{{ route('cart.index') }}"
                   class="nav-link {{ request()->routeIs('cart.*') ? 'active' : '' }}">
                    🛒 Keranjang
                </a>
            </nav>

            <div class="header-actions">
                @auth
                    <a class="btn btn-dark" href="{{ route('admin.dashboard') }}">▦ Dashboard</a>

                    <form method="POST" action="{{ route('logout') }}" style="display:inline;" data-confirm-submit data-confirm-title="Logout?" data-confirm-message="Anda akan keluar dari dashboard admin.">
                        @csrf
                        <button class="btn btn-ghost" type="submit">↪ Logout</button>
                    </form>
                @else
                    <a class="btn btn-dark" href="{{ route('login') }}">Login Admin</a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-grid">
            <div class="footer-about">
                <a class="brand footer-logo" href="{{ route('home') }}">
                    <span class="brand-mark">GT</span>
                    <span class="brand-name">{{ $siteSetting->site_name ?? 'GandengTangan' }}</span>
                </a>
                <p>{{ $siteSetting->short_description ?? 'Katalog inklusif untuk membantu pengrajin disabilitas memasarkan karya dan produk mereka.' }}</p>
            </div>
            <div class="footer-col">
                <h3>Navigasi</h3>
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('catalog') }}">Katalog</a>
                <a href="{{ route('about') }}">Tentang</a>
                <a href="{{ route('how_to_buy') }}">Cara Membeli</a>
            </div>
            <div class="footer-col">
                <h3>Kontak</h3>
                <span>{{ optional($siteSetting)->contact_email ?: 'halo@gandengtangan.id' }}</span>
                <span>{{ optional($siteSetting)->address ?: 'Indonesia' }}</span>
                <a href="https://wa.me/{{ preg_replace('/\D+/', '', optional($siteSetting)->whatsapp_number ?? '6281361428113') }}" target="_blank" rel="noreferrer">WhatsApp Admin</a>
            </div>
        </div>
        <div class="container footer-bottom">&copy; {{ date('Y') }} GandengTangan. Semua hak dilindungi.</div>
    </footer>
    @include('components.confirm-modal')
    <script>
        document.addEventListener('click', function (event) {
            const toggle = event.target.closest('.mobile-menu-toggle');
            if (!toggle) return;
            const nav = document.getElementById('mainNav');
            const isOpen = nav.classList.toggle('open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            toggle.textContent = isOpen ? '×' : '☰';
        });
    </script>
</body>
</html>
