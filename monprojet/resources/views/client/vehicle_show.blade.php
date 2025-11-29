<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $vehicle->brand ?? 'Véhicule' }} - {{ $vehicle->model ?? 'Détails' }} | AutoGestion</title>
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

            /* Spécifique à la page de détails */
            --detail-card-bg: #1F2A37; /* Utiliser le même fond que les cartes pour la cohérence */
            --detail-card-text: var(--text-light);
            --detail-card-shadow: rgba(0,0,0,0.6);
            --detail-border: #3d526a; 
            --btn-logout-color: var(--bg-page);
            --price-loan-color: var(--secondary-color);
            --price-purchase-color: var(--primary-color);
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
            
            --detail-card-bg: #ffffff; 
            --detail-card-text: #343a40; 
            --detail-card-shadow: rgba(0,0,0,0.15);
            --detail-border: #e9ecef;
            --btn-logout-color: #fff;
            --price-loan-color: var(--secondary-color);
            --price-purchase-color: var(--primary-color);
        }

        /* =================================================================== */
        /* === 2. Styles de Base & Topbar (Réutilisés) ======================= */
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
        /* === 3. Styles Spécifiques DÉTAILS VÉHICULE (Ultra Stylisé) ======== */
        /* =================================================================== */
        .main-content {
            padding: 40px 60px 80px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        /* Bouton retour */
        .back-link {
            text-decoration: none; font-weight: 600; font-size: 1rem; display: inline-flex;
            align-items: center; gap: 8px; margin-bottom: 30px; 
            color: var(--text-muted) !important;
            transition: color 0.2s;
        }
        .back-link:hover { 
            color: var(--primary-color) !important; 
            transform: translateX(-5px);
        }
        
        /* Card info */
        .vehicle-info {
            background: var(--detail-card-bg); 
            color: var(--detail-card-text); 
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0px 15px 40px var(--detail-card-shadow); 
            height: 100%; 
            transition: background 0.3s, box-shadow 0.3s, color 0.3s;
        }

        .vehicle-info h2 {
            font-weight: 900;
            font-size: 2.2rem;
            color: var(--primary-color);
            border-bottom: 2px solid var(--detail-border);
            padding-bottom: 15px;
            margin-top: 0;
            margin-bottom: 20px;
            transition: color 0.3s, border-color 0.3s;
        }

        .vehicle-info h3 {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--detail-card-text);
            margin-top: 30px;
            margin-bottom: 15px;
        }
        
        /* Image */
        .img-fluid {
            box-shadow: 0 15px 50px var(--detail-card-shadow);
            border: 8px solid var(--card-bg); /* Bordure épaisse pour un look premium */
            width: 100%;
            max-height: 500px;
            object-fit: cover;
            border-radius: 20px !important;
            transition: border-color 0.3s;
        }
        
        /* Spécifications (Grid) */
        .specs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .spec-item {
            background: var(--bg-page); /* Fond de carte secondaire */
            padding: 15px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid var(--detail-border);
            transition: background 0.3s, border-color 0.3s;
        }
        .light-mode .spec-item { background: var(--detail-card-bg); border: 1px solid var(--detail-border); }

        .spec-item i { color: var(--secondary-color); font-size: 1.5rem; margin-bottom: 5px; }
        .spec-item p { margin: 0; font-size: 0.9rem; color: var(--text-muted); }
        .spec-item strong { 
            color: var(--text-light); 
            font-weight: 700;
            display: block;
            font-size: 1.1rem;
        }
        .light-mode .spec-item strong { color: var(--detail-card-text); }


        /* Prix et Statut */
        .price-loan {
            color: var(--price-loan-color);
            font-weight: 900;
            font-size: 2rem;
        }
        .price-purchase {
            color: var(--price-purchase-color);
            font-weight: 900;
            font-size: 1.8rem;
        }

        .status-badge {
            font-size: 1.1rem;
            padding: 8px 15px;
            border-radius: 50px;
        }
        
        /* Boutons d'Action Harmonisation */
        .btn-large {
            padding: 14px; font-size: 18px; font-weight: 700; border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s, opacity 0.3s;
        }
        .btn-large:hover { transform: translateY(-3px); }
        
        /* Louer (Primaire / Jaune brillant) */
        .btn-loan {
            background-color: var(--secondary-color) !important;
            border-color: var(--secondary-color) !important;
            color: var(--bg-page) !important;
        }
        .btn-loan:hover {
            background-color: #2ecc71 !important; 
            box-shadow: 0 5px 15px rgba(78, 205, 196, 0.5);
        }
        
        /* Acheter (Primaire / Rouge) */
        .btn-purchase {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }
        .btn-purchase:hover {
            background-color: #e65c5c !important;
            box-shadow: 0 5px 15px rgba(255, 107, 107, 0.5);
        }

        /* Ajouter au Panier (Secondaire / Dark ou Light) */
        .btn-cart {
            background-color: var(--card-bg) !important;
            border-color: var(--card-bg) !important;
            color: var(--text-light) !important;
        }
        .light-mode .btn-cart {
            background-color: var(--bg-page) !important;
            border-color: var(--bg-page) !important;
            color: var(--text-light) !important;
        }
        .btn-cart:hover {
            background-color: var(--bg-page) !important; 
            border-color: var(--bg-page) !important;
        }

        .btn-large:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: none !important;
        }

        /* Alertes */
        .alert-success {
            background-color: var(--secondary-color);
            color: var(--bg-page);
            border: none;
            font-weight: 600;
            margin-bottom: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(78, 205, 196, 0.3);
        }

        /* Animation d'apparition */
        .fade-in { 
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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('client.vehicles') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour au catalogue
    </a>

    <div class="row fade-in g-5">

        {{-- COLONNE GAUCHE : IMAGE --}}
        <div class="col-md-6">
            <img src="/storage/{{ $vehicle->image }}" 
                 alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                 class="img-fluid rounded">
        </div>

        {{-- COLONNE DROITE : DÉTAILS ET ACTIONS --}}
        <div class="col-md-6">
            <div class="vehicle-info">

                {{-- Titre et Statut --}}
                <h2 class="mb-2">{{ $vehicle->brand }} - {{ $vehicle->model }}</h2>

                <p class="mb-4">
                    <span class="status-badge {{ $vehicle->status ? 'bg-success' : 'bg-secondary' }}">
                        <i class="fas fa-circle me-1"></i> **{{ $vehicle->status ? 'Disponible Immédiatement' : 'Indisponible' }}**
                    </span>
                </p>

                <hr>

                {{-- Spécifications Techniques (FICHE DE LUXE) --}}
                <h3><i class="fas fa-tachometer-alt me-2"></i> Spécifications Clés</h3>
                <div class="specs-grid">
                    <div class="spec-item">
                        <i class="fas fa-calendar-alt"></i>
                        <p>Année</p>
                        <strong>{{ $vehicle->year ?? 'N/A' }}</strong>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-gas-pump"></i>
                        <p>Carburant</p>
                        <strong>{{ $vehicle->fuel_type ?? 'Essence' }}</strong>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-cogs"></i>
                        <p>Transmission</p>
                        <strong>{{ $vehicle->transmission ?? 'Automatique' }}</strong>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-users"></i>
                        <p>Places</p>
                        <strong>{{ $vehicle->seats ?? '5' }}</strong>
                    </div>
                    <div class="spec-item">
                        <i class="fas fa-route"></i>
                        <p>Kilométrage</p>
                        <strong>{{ number_format($vehicle->mileage ?? 0) }} km</strong>
                    </div>
                </div>

                {{-- Prix --}}
                <hr>

                <div class="mb-4">
                    <p class="fw-bold price-loan mb-1">
                        <i class="fas fa-key me-2"></i> Location : {{ number_format($vehicle->loan_price ?? 0) }} USD / jour
                    </p>
                    <p class="fw-bold price-purchase">
                        <i class="fas fa-tags me-2"></i> Achat : {{ number_format($vehicle->price ?? 0) }} USD
                    </p>
                </div>
                
                <hr>

                {{-- Boutons d'Action --}}
                <div class="d-grid gap-3">
                    
                    {{-- Louer Maintenant (Couleur Secondaire) --}}
                    <form method="POST" action="{{ route('client.loan.start', $vehicle->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-loan btn-large w-100" {{ $vehicle->status ? '' : 'disabled' }}>
                            <i class="fas fa-road me-2"></i> Louer Immédiatement
                        </button>
                    </form>

                    {{-- Acheter (Couleur Primaire) --}}
                    <form action="{{ route('client.purchase.start', $vehicle->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-purchase w-100 btn-large">
                            <i class="fas fa-handshake me-2"></i> Acheter ce Véhicule
                        </button>
                    </form>

                    {{-- Ajouter au Panier (Couleur de fond de carte) --}}
                    <form method="POST" action="{{ route('client.cart.add', $vehicle->id) }}">
                        @csrf
                        <button type="submit" class="btn btn-cart btn-large w-100" {{ $vehicle->status ? '' : 'disabled' }}>
                            <i class="fas fa-shopping-cart me-2"></i> Ajouter au Panier
                        </button>
                    </form>

                </div>

            </div>
        </div>
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