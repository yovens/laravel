<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Véhicules Disponibles | AutoGestion (Autonome)</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">



    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            --primary-color: #FF6B6B; 
            --secondary-color: #4ECDC4; 
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #1F2937; 
            --card-bg: #2C3E50; 
            --topbar-height: 65px;
            
            --form-bg: #1a232f;
            --form-border: #3d526a;
            --shadow-color: rgba(0, 0, 0, 0.25);
            --price-badge-bg: rgba(44, 62, 80, 0.85);
            --card-detail-border: #3d526a; 
            --btn-logout-color: var(--bg-page);
        }

        /* =================================================================== */
        /* === 1.1 Variables Light Mode ====================================== */
        /* =================================================================== */
        .light-mode {
            --primary-color: #007bff;
            --secondary-color: #28a745;
            --text-light: #343a40;
            --text-muted: #6c757d; 
            --bg-page: #f8f9fa;
            --card-bg: #ffffff;
            
            --form-bg: #ffffff; 
            --form-border: #ced4da; 
            --shadow-color: rgba(0, 0, 0, 0.15);
            --price-badge-bg: rgba(255, 255, 255, 0.9);
            --card-detail-border: #dee2e6;
            --btn-logout-color: #fff;
        }


        /* =================================================================== */
        /* === 2. Styles de Base (Avec Transition) =========================== */
        /* =================================================================== */
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light);
            padding-top: var(--topbar-height); 
            transition: background-color 0.3s, color 0.3s;
        }
        
        /* 3. Topbar (Corrigée et Thème Adaptatif) */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg); 
            box-shadow: 0 4px 15px var(--shadow-color);
            display: flex;
            align-items: center;
            justify-content: space-between; /* Ajouté pour séparer les éléments */
            padding: 0 40px;
            position: fixed; 
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
            transition: background 0.3s, box-shadow 0.3s;
        }

        .logo { font-size: 22px; font-weight: 700; color: var(--primary-color); text-decoration: none; margin-right: 30px; white-space: nowrap; }
        .logo i { color: var(--primary-color); margin-right: 5px; }

        .topbar-nav { display: flex; align-items: center; flex-grow: 1; margin-right: auto; }
        .topbar-nav a {
            color: var(--text-muted); font-weight: 500; padding: 8px 15px; text-decoration: none;
            transition: color 0.3s, border-bottom 0.3s; border-bottom: 3px solid transparent; margin: 0 5px;
            font-size: 0.95rem; display: inline-flex; align-items: center; gap: 6px; white-space: nowrap;
        }

        .topbar-nav a:hover, .topbar-nav a.active { color: var(--primary-color); border-bottom: 3px solid var(--primary-color); }

        .topbar-actions { display: flex; align-items: center; gap: 15px; }
        
        .btn-logout {
            border: 1px solid var(--primary-color); color: var(--primary-color); background-color: transparent;
            padding: 6px 15px; font-size: 0.9rem; border-radius: 6px; transition: all 0.2s; text-transform: uppercase;
        }
        .btn-logout:hover {
            background-color: var(--primary-color); color: var(--btn-logout-color);
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.4);
        }
        
        /* NOUVEAU: Bouton de bascule de thème */
        .btn-theme-toggle {
            background: none; border: none; color: var(--text-muted); font-size: 1.5rem;
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover { color: var(--primary-color); transform: scale(1.1); }


        /* =================================================================== */
        /* === 4. Contenu de la Page Véhicules (Adaptation Thème) ============ */
        /* =================================================================== */
        .main-content { padding: 40px 40px 80px 40px; }
        
        .page-header-vehicles { color: var(--primary-color); transition: color 0.3s; }
        .page-header-vehicles i { color: var(--primary-color); }
        
        /* Filtres Adaptatifs */
        .filter-card {
            background: var(--card-bg);
            border: 1px solid var(--form-border);
            border-radius: 15px;
            box-shadow: 0 8px 30px var(--shadow-color);
            margin-bottom: 50px;
            padding: 25px 35px;
            transition: background 0.3s, box-shadow 0.3s, border-color 0.3s;
        }
        
        /* Champs de formulaire (Input/Select) Adaptatifs */
        .form-control, .form-select {
            background-color: var(--form-bg) !important;
            border: 1px solid var(--form-border) !important; 
            color: var(--text-light) !important;
            border-radius: 8px;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }
        .form-control::placeholder {
            color: var(--text-muted);
            opacity: 0.6;
        }
        .search-icon { color: var(--text-muted); transition: color 0.3s; }
        
        /* Cartes de Véhicules Adaptatives */
        .card-vehicle {
            background: var(--card-bg);
            box-shadow: 0 10px 40px var(--shadow-color);
            transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid var(--form-border);
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
        }
        .card-vehicle:hover {
            box-shadow: 0 20px 50px var(--shadow-color);
        }
        
        /* Badge de Prix */
        .price-badge {
            position: absolute;
            bottom: 15px;
            right: 0;
            background: var(--price-badge-bg); 
            color: var(--secondary-color); 
            font-size: 1.3rem;
            font-weight: 700;
            padding: 5px 15px 5px 25px;
            border-radius: 10px 0 0 10px;
            box-shadow: -5px 5px 15px var(--shadow-color);
            z-index: 10;
            transition: background 0.3s, color 0.3s;
        }
        
        /* Détails */
        .card-body h5 { color: var(--text-light); transition: color 0.3s; }
        .vehicle-details { border-bottom: 1px solid var(--card-detail-border); transition: border-color 0.3s; }
        .vehicle-details span i { color: var(--primary-color); }

        /* Boutons */
        .btn-details {
            background-color: var(--primary-color);
            color: var(--bg-page);
        }
        .btn-outline-action {
            border-color: var(--text-muted); 
            color: var(--text-muted); 
        }
        .btn-outline-action:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .vehicle-image-container {
            height: 250px;
            overflow: hidden;
            position: relative;
        }
        .card-vehicle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .card-vehicle:hover img {
            transform: scale(1.1);
        }
        
        /* Reste des styles... */

    </style>
</head>
<body class="dark-mode"> <header class="topbar">
    <a href="{{ route('client.dashboard') }}" class="logo">
      AutoGestion
    </a>
    
    <nav class="topbar-nav">
        <a href="{{ route('client.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}" class="active"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('client.about') }}"><i class="fas fa-info-circle"></i> À Propos</a>
        <a href="{{ route('client.contact') }}"><i class="fas fa-headset"></i> Contact</a> 
    </nav>
    
    <div class="topbar-actions">
        
        <button id="theme-toggle" class="btn-theme-toggle" aria-label="Basculer le thème clair/sombre">
            <i class="fas fa-sun"></i> 
        </button>
        
        <form method="POST" action="{{ route('logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-logout">
                <i class="fas fa-power-off"></i> DÉCONNEXION
            </button>
        </form>
    </div>
</header>

<main class="main-content">
    <br>
    <br>
    <h2 class="page-header-vehicles"> Notre Flotte de Véhicules de Prestige</h2>
<br>
    <div class="filter-card">
        <form method="GET" action="{{ route('client.vehicles') }}">

            <div class="row g-3 align-items-center">

                <div class="col-md-4 position-relative">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control search-input"
                            placeholder="Rechercher (marque, modèle...)">
                </div>

                <div class="col-md-3">
                    <select name="brand" class="form-select">
                        <option value="">Toutes les marques</option>
                        @foreach($brands as $b)
                            <option value="{{ $b }}" {{ request('brand')==$b ? 'selected':'' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="year" class="form-select">
                        <option value="">Année</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year')==$y ? 'selected':'' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1">
                    <input type="number" class="form-control"
                            name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                </div>

                <div class="col-md-1">
                    <input type="number" class="form-control"
                            name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                </div>

                <div class="col-md-1">
                    <button class="btn btn-filter-ok w-100">OK</button>
                </div>

            </div>
        </form>
    </div>

    <div class="row g-5">
    @foreach($vehicles as $i => $v)
    <div class="col-md-4 fade-item" style="animation-delay: {{ $i * 0.10 }}s">
        <div class="card card-vehicle">

            <div class="vehicle-image-container">
                <img src="/storage/{{ $v->image }}" alt="{{ $v->brand }} {{ $v->model }}" class="card-img-top"> 
                <span class="price-badge">{{ number_format($v->price) }} USD </span>
            </div>

            <div class="card-body">
                <h5>{{ $v->brand }} - {{ $v->model }}</h5>
                
                <div class="vehicle-details">
                    <span title="Année"><i class="fas fa-calendar-alt"></i> {{ $v->year }}</span>
                    <span title="Type de Carburant"><i class="fas fa-gas-pump"></i> Essence</span> 
                    <span title="Transmission"><i class="fas fa-cogs"></i> Auto</span>
                </div>

                <a href="{{ route('client.vehicle.show', $v->id) }}"
                   class="btn btn-details w-100">
                    <i class="fas fa-info-circle"></i> Voir Détails
                </a>
                <button class="btn btn-outline-action w-100 mt-2 rounded-pill">
                    <i class="fas fa-shopping-cart"></i> Ajouter au Panier
                </button>
            </div>

        </div>
    </div>
    @endforeach
    </div>
    
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('theme-toggle');
        const body = document.body;
        
        if (!toggleButton) return; 
        const icon = toggleButton.querySelector('i');

        const applyTheme = (isLight) => {
            if (isLight) {
                body.classList.add('light-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon'); 
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.remove('light-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun'); 
                localStorage.setItem('theme', 'dark');
            }
        };

        // Charger le thème sauvegardé, sinon utiliser le thème sombre par défaut
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'light') {
            applyTheme(true);
        } else {
            applyTheme(false); 
        }

        toggleButton.addEventListener('click', () => {
            const isLight = body.classList.contains('light-mode');
            applyTheme(!isLight);
        });
    });
</script>
</body>
</html>