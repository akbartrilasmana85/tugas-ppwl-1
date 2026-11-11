<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul ?? 'CampusInfo' }} - CampusInfo</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 0; background: #f4f6f8; color: #222; }
        nav { background: #1e3a5f; padding: 12px 24px; }
        nav a { color: #fff; text-decoration: none; margin-right: 18px; }
        nav a.aktif { text-decoration: underline; }
        main { max-width: 900px; margin: 24px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; background: #fff; }
        th, td { border: 1px solid #ccd; padding: 8px; text-align: left; }
        th { background: #1e3a5f; color: #fff; }
        .kartu { background: #fff; padding: 16px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
<nav>
    <a href="{{ route('beranda') }}" class="{{ request()->routeIs('beranda') ? 'aktif' : '' }}">Beranda</a>
    <a href="{{ route('program-studi') }}" class="{{ request()->routeIs('program-studi') ? 'aktif' : '' }}">Program Studi</a>
    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'aktif' : '' }}">Kontak</a>
    <a href="{{ route('architecture.dashboard') }}" class="{{ request()->routeIs('architecture.*') ? 'aktif' : '' }}">Architecture</a>
</nav>
<main>
    @yield('konten')
</main>
</body>
</html>
