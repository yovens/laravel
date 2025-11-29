<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Véhicules Disponibles | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Liens Externes --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            --primary-color: #FF6B6B; /* Rouge Corail Vif */
            --secondary-color: #4ECDC4; /* Cyan/Vert d'eau */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #161B22; /* Noir très foncé, proche du GitHub Dark */
            --card-bg: #1F2A37; 
            --topbar-height: 70px;

            /* Formulaires et Cartes */
            --form-bg: #1a232f;
            --form-border: #3d526a;
            --shadow-color: rgba(0, 0, 0, 0.5); /* Ombre plus intense */
            --price-badge-bg: var(--primary-color); /* Badge de prix en couleur primaire */
            --price-badge-text: var(--bg-page);
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
            --bg-page: #f4f6f9;
            --card-bg: #ffffff;
            
            --form-bg: #ffffff; 
            --form-border: #ced4da; 
            --shadow-color: rgba(0, 0, 0, 0.15);
            --price-badge-bg: var(--secondary-color);
            --price-badge-text: #fff;
            --card-detail-border: #dee2e6;
            --btn-logout-color: #fff;
        }


        /* =================================================================== */
        /* === 2. Styles de Base & Topbar (Réutilisés du Dashboard) ========== */
        /* =================================================================== */
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light);
            padding-top: var(--topbar-height); 
            transition: background-color 0.4s, color 0.4s;
        }
            .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: 0 4px 15px var(--shadow-color);
            border-bottom: 1px solid var(--card-border-color);
            padding: 0 40px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: background 0.4s, border-color 0.4s;
        }
        
        .logo { 
            font-size: 24px; 
            font-weight: 800;
            color: var(--primary-color); 
            text-shadow: 0 0 5px rgba(255, 107, 107, 0.3);
            text-decoration: none;
        }
        .light-mode .logo { text-shadow: none; }

        .topbar-nav a {
            color: var(--text-muted);
            font-weight: 500;
            padding: 8px 15px;
            border-radius: 8px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px; 
            border-bottom: 3px solid transparent; /* Pour l'effet active */
        }

        .topbar-nav a:hover, .topbar-nav a.active {
            color: var(--primary-color);
            background-color: var(--bg-page); 
            border-bottom: 3px solid var(--primary-color);
        }
        
   /* 3. Boutons Topbar */
    .topbar-actions { display: flex; align-items: center; gap: 15px; }
    .btn-theme-toggle {
      background: rgba(255, 255, 255, 0.1);
      border: 2px solid var(--text-muted);
      color: var(--secondary-color);
      font-size: 1.2rem;
      width: 45px; height: 45px; padding: 0;
      border-radius: 50%; cursor: pointer;
      transition: all 0.3s ease;
      display: flex; justify-content: center; align-items: center;
      backdrop-filter: blur(5px);
    }

    .btn-theme-toggle:hover {
      color: var(--text-light);
      background: var(--primary-color);
      transform: rotate(360deg);
      box-shadow: 0 0 20px var(--glow-primary);
      border-color: var(--primary-color);
    }

    .ultra-icon-button {
      width: 45px; height: 45px; padding: 0; font-size: 1.1rem;
      display: flex; justify-content: center; align-items: center;
      border-radius: 50%; border: 2px solid var(--primary-color);
      background: transparent; color: var(--primary-color);
      position: relative; transition: all 0.4s ease;
      box-shadow: 0 0 5px rgba(13, 148, 136, 0.3);
    }
    .ultra-icon-button:hover {
      background: var(--primary-color); color: var(--bg-page);
      transform: scale(1.1); box-shadow: 0 0 20px var(--glow-primary);
    }
    .ultra-icon-button::before, .ultra-icon-button::after { /* Tooltip */ opacity: 0; transition: opacity 0.3s; }
    .ultra-icon-button::before { content: attr(data-tooltip); position: absolute; bottom: -35px; left: 50%; transform: translateX(-50%); background: var(--secondary-color); color: var(--bg-page); padding: 5px 10px; border-radius: 6px; font-size: 0.8rem; font-weight: 700; white-space: nowrap; pointer-events: none; z-index: 1001; }
    .ultra-icon-button:hover::before { opacity: 1; visibility: visible; bottom: -45px; }
    .ultra-icon-button:hover::after { opacity: 1; visibility: visible; }

        /* =================================================================== */
        /* === 3. Contenu de la Page Véhicules (Spécifique) ================== */
        /* =================================================================== */
        .main-content { 
            padding: 40px 60px 80px 60px; 
            max-width: 1600px; /* Plus large pour le catalogue */
            margin: 0 auto;
        }
        
        /* Titre de la page */
        .page-header-vehicles {
            font-size: 2.5rem;
            font-weight: 800;
             background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
        }
        .page-header-vehicles i { 
            color: var(--primary-color); 
            margin-right: 10px;
        }
        
        /* Filtres Styles */
        .filter-card {
            background: var(--card-bg);
            border: 1px solid var(--form-border);
            border-radius: 15px;
            box-shadow: 0 8px 30px var(--shadow-color);
            margin-bottom: 50px;
            padding: 20px 30px; /* Moins de padding */
            transition: background 0.3s, box-shadow 0.3s, border-color 0.3s;
        }
        
        /* Champs de formulaire */
        .form-control, .form-select {
            background-color: var(--form-bg) !important;
            border: 1px solid var(--form-border) !important; 
            color: var(--text-light) !important;
            border-radius: 8px;
            padding: 10px 15px;
            transition: background-color 0.3s, border-color 0.3s, color 0.3s;
        }
        .form-control::placeholder { color: var(--text-muted); opacity: 0.7; }

        /* Bouton de filtrage */
        .btn-filter-ok {
            background-color: var(--secondary-color);
            color: var(--bg-page);
            font-weight: 600;
            transition: all 0.3s;
            border-radius: 8px;
        }
        .btn-filter-ok:hover {
            background-color: #2ecc71; /* Vert plus vif */
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.5);
            transform: translateY(-2px);
        }
        
        /* Icone de recherche dans le champ */
        .search-icon { 
            position: absolute; 
            left: 25px; 
            top: 50%; 
            transform: translateY(-50%); 
            color: var(--text-muted); 
            transition: color 0.3s; 
            z-index: 5;
        }
        .search-input { padding-left: 40px !important; }
        
        /* --- Cartes de Véhicules --- */
        .card-vehicle {
            background: var(--card-bg);
            box-shadow: 0 10px 40px var(--shadow-color);
            transition: all .4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid var(--form-border);
            border-radius: 20px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .card-vehicle:hover {
            transform: translateY(-8px); /* Élévation au survol */
            box-shadow: 0 20px 50px var(--shadow-hover);
        }
        
        /* Image */
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
            transform: scale(1.15); /* Zoom plus grand */
        }
        
        /* Badge de Prix */
        .price-badge {
            position: absolute;
            bottom: 15px;
            right: 0;
            background: var(--price-badge-bg); 
            color: var(--price-badge-text); 
            font-size: 1.4rem;
            font-weight: 800;
            padding: 8px 20px 8px 30px;
            border-radius: 15px 0 0 15px;
            box-shadow: -5px 5px 15px var(--shadow-color);
            z-index: 10;
            transition: all 0.3s;
        }

        /* Corps de la carte */
        .card-body {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .card-body h5 { 
            color: var(--text-light); 
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        /* Détails techniques */
        .vehicle-details { 
            border-bottom: 1px solid var(--card-detail-border); 
            transition: border-color 0.3s; 
            padding-bottom: 15px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }
        .vehicle-details span { 
            font-size: 0.9rem;
            color: var(--text-muted);
            white-space: nowrap;
        }
        .vehicle-details span i { 
            color: var(--primary-color);
            margin-right: 5px;
        }

        /* Boutons d'Action */
        .btn-details {
            background-color: var(--primary-color);
            color: white; /* Texte blanc sur fond primaire */
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
            margin-bottom: 10px;
        }
        .btn-details:hover {
            background-color: #ff4747;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.5);
        }

        .btn-outline-action {
            border: 1px solid var(--secondary-color); 
            color: var(--secondary-color); 
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-outline-action:hover {
            background-color: var(--secondary-color);
            color: var(--bg-page);
            box-shadow: 0 5px 15px rgba(78, 205, 196, 0.5);
            transform: translateY(-2px);
        }

        /* Animation d'apparition */
        .fade-item { 
            opacity: 0; 
            transform: translateY(20px); 
            animation: fadeInSlide 0.5s ease-out forwards;
        }
        @keyframes fadeInSlide { 
            to { opacity: 1; transform: translateY(0); } 
        }

    </style>
</head>
<body class="dark-mode"> 
<header class="topbar">
    <a href="{{ route('client.dashboard') }}" class="logo">
        AutoGestion
    </a>
    
    <nav class="topbar-nav d-none d-lg-flex">
        <a href="{{ route('client.dashboard') }}" ><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}" class="active"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('client.contact') }}"><i class="fas fa-headset"></i> Contact</a> 
    </nav>
    
   <div class="topbar-actions">
 
    <button id="theme-toggle" class="btn-theme-toggle" aria-label="Basculer le thème clair/sombre">
      <i class="fas fa-moon"></i>
    </button>

    <form method="POST" action="{{ route('logout') }}" class="d-inline">
      @csrf
      {{-- Bouton à icône unique avec un libellé Tooltip --}}
      <button type="submit" class="btn btn-logout ultra-icon-button" data-tooltip="Déconnexion">
        <i class="fas fa-power-off"></i>
      </button>
    </form>
  </div>
</header>

<main class="main-content">
    <br>
    <br>
    <h2 class="page-header-vehicles">
        <i class="fas fa-road"></i> Notre Flotte de Véhicules de Prestige
    </h2>
<br>
    {{-- Formulaire de Filtre Ultra Stylé --}}
    <div class="filter-card">
        <form method="GET" action="{{ route('client.vehicles') }}">

            <div class="row g-3 align-items-center justify-content-center">

                <div class="col-md-4 position-relative">
                    <i class="fa fa-search search-icon"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control search-input"
                            placeholder="Rechercher (marque, modèle...)">
                </div>

                <div class="col-md-2 col-sm-6">
                    <select name="brand" class="form-select">
                        <option value="">Toutes les marques</option>
                        @foreach($brands as $b)
                            <option value="{{ $b }}" {{ request('brand')==$b ? 'selected':'' }}>{{ $b }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 col-sm-6">
                    <select name="year" class="form-select">
                        <option value="">Année</option>
                        @foreach($years as $y)
                            <option value="{{ $y }}" {{ request('year')==$y ? 'selected':'' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-1 col-sm-6">
                    <input type="number" class="form-control"
                            name="min_price" placeholder="Min Prix" value="{{ request('min_price') }}">
                </div>

                <div class="col-md-1 col-sm-6">
                    <input type="number" class="form-control"
                            name="max_price" placeholder="Max Prix" value="{{ request('max_price') }}">
                </div>

                <div class="col-md-1 col-sm-12">
                    <button type="submit" class="btn btn-filter-ok w-100">
                        <i class="fas fa-filter d-md-none d-inline"></i> Filtrer
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- Liste des Véhicules --}}
    <div class="row g-5">
    @foreach($vehicles as $i => $v)
    <div class="col-xl-4 col-lg-6 col-md-6 fade-item" style="animation-delay: {{ $i * 0.10 }}s">
        <div class="card card-vehicle">

            <div class="vehicle-image-container">
                <img src="/storage/{{ $v->image }}" alt="{{ $v->brand }} {{ $v->model }}" class="card-img-top"> 
                <span class="price-badge">{{ number_format($v->price) }} USD / jour </span>
            </div>

            <div class="card-body">
                <h5>{{ $v->brand }} - {{ $v->model }}</h5>
                
                <div class="vehicle-details">
                    <span title="Année"><i class="fas fa-calendar-alt"></i> {{ $v->year }}</span>
                    <span title="Type de Carburant"><i class="fas fa-gas-pump"></i> Essence</span> 
                    <span title="Transmission"><i class="fas fa-cogs"></i> Auto</span>
                </div>

                {{-- Conteneur des Boutons --}}
                <div class="mt-auto"> 
                    <a href="{{ route('client.vehicle.show', $v->id) }}"
                       class="btn btn-details w-100">
                        <i class="fas fa-info-circle"></i> Voir Détails
                    </a>
                    {{-- Le bouton 'Ajouter au Panier' est sécurisé contre les erreurs (si la route n'existe pas) --}}
                    @if (Route::has('client.cart.add'))
                    <button class="btn btn-outline-action w-100">
                        <i class="fas fa-shopping-cart"></i> 
                    </button>
                    @endif
                </div>

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
            // Dark Mode par défaut
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