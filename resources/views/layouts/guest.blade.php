<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'GandengTangan') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/public.css') }}">
</head>
<body>
    <main>
        {{ $slot }}
    </main>
</body>
</html>
