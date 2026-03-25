<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin - GandengTangan')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/public.css') }}">
</head>
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <span class="admin-mark">◆</span>
                <div>
                    <div class="admin-name">GandengTangan</div>
                    <div class="admin-sub">Admin Panel</div>
                </div>
            </div>

            <nav class="admin-nav">
                <a class="admin-link active" href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a class="admin-link" href="#">Products</a>
                <a class="admin-link" href="#">Artists</a>
                <a class="admin-link" href="#">Categories</a>
                <a class="admin-link" href="#">Organizations</a>
            </nav>

            <div class="admin-sidefoot">
                <div class="admin-user">
                    <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</div>
                    <div class="admin-user-meta">
                        <div class="admin-user-name">{{ auth()->user()->name ?? '-' }}</div>
                        <div class="admin-user-email">{{ auth()->user()->email ?? '-' }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost admin-logout">Logout</button>
                </form>
            </div>
        </aside>

        <div class="admin-main">
            <header class="admin-topbar">
                <div class="admin-top-left">
                    <div class="admin-page-title">@yield('page_title', 'Dashboard')</div>
                    <div class="admin-page-sub">@yield('page_subtitle', 'Ringkasan aktivitas dan data terbaru')</div>
                </div>

                <div class="admin-top-right">
                    <a class="btn btn-primary" href="/" target="_blank" rel="noreferrer">Lihat Website →</a>
                </div>
            </header>

            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>