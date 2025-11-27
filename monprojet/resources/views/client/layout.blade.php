<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Espace Client')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f5f7fa; }
        .sidebar { width: 250px; min-height: 100vh; background: #111827; position: fixed; padding-top: 30px; color: white; }
        .sidebar a { color: #d1d5db; display: block; padding: 12px 25px; text-decoration: none; transition: .2s; }
        .sidebar a:hover { background: #1f2937; color: white; }
        .sidebar-title { padding: 0 25px; font-size: 20px; font-weight: bold; margin-bottom: 25px; }
        .main { margin-left: 250px; padding: 30px; }
        .card-vehicle img { height: 220px; object-fit: cover; }
        footer { margin-top: 40px; padding: 20px; background: #e5e7eb; text-align: center; border-radius: 10px; }
    </style>
    @yield('styles')
</head>
<body>

<div class="sidebar">
    <div class="sidebar-title">🚗 Client Panel</div>
    <a href="{{ route('client.dashboard') }}">Dashboard</a>
    <a href="{{ route('client.vehicles') }}">Véhicules</a>
    <a href="{{ route('client.cart') }}">Panier</a>
    <a href="{{ route('client.loan') }}">Locations</a>
    <a href="{{ route('client.transactions') }}">Transactions</a>
    <a href="{{ route('client.about') }}">À propos</a>
    <a href="{{ route('client.contact') }}">Contact</a>
    <hr style="border-color:#374151;">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-danger w-75 ms-3">Déconnexion</button>
    </form>
</div>

<div class="main">
    @yield('content')
</div>

</body>
</html>
