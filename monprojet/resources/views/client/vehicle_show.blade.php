<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $vehicle->brand ?? 'Véhicule' }} - {{ $vehicle->model ?? 'Détails' }} | AutoGestion</title>
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

            --detail-card-bg: #ffffff;
            --detail-card-text: #1F2937;
            --detail-card-shadow: rgba(0,0,0,0.3);
            --detail-border: #ddd;
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
            
            --detail-card-bg: #f0f3f6; 
            --detail-card-text: #343a40; 
            --detail-card-shadow: rgba(0,0,0,0.15);
            --detail-border: #e9ecef;
            --btn-logout-color: #fff;
        }

        /* =================================================================== */
        /* === 2. Styles de Base (Adaptatif) ================================= */
        /* =================================================================== */
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light);
            padding-top: var(--topbar-height); 
            transition: background-color 0.3s, color 0.3s;
        }
        
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg); 
            box-shadow: 0 4px 15px var(--detail-card-shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
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
            background-color: var(--primary-color); 
            color: var(--btn-logout-color);
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.4);
        }
        
        .btn-theme-toggle {
            background: none; border: none; color: var(--text-muted); font-size: 1.5rem;
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover { color: var(--primary-color); transform: scale(1.1); }
        
        /* =================================================================== */
        /* === 3. Styles Spécifiques DÉTAILS VÉHICULE (Adaptatif) ============ */
        /* =================================================================== */
        .main-content {
            padding: 40px 40px 80px 40px;
        }
        
        /* Bouton retour Adaptatif */
        .back-link {
            text-decoration: none; font-weight: 700; font-size: 1rem; display: inline-flex;
            align-items: center; gap: 6px; margin-bottom: 30px; 
            color: var(--text-light) !important;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary-color) !important; }
        
        /* Card info (BLANCHE ou GRISE CLAIRE) */
        .vehicle-info {
            background: var(--detail-card-bg); 
            color: var(--detail-card-text); 
            border-radius: 15px;
            padding: 35px;
            box-shadow: 0px 10px 30px var(--detail-card-shadow); 
            height: 100%; 
            transition: background 0.3s, box-shadow 0.3s;
        }

        .vehicle-info h2 {
            font-weight: 700;
            color: var(--detail-card-text);
            border-bottom: 2px solid var(--detail-border);
            padding-bottom: 10px;
            margin-top: 0;
            transition: color 0.3s, border-color 0.3s;
        }
        
        .btn-large {
            padding: 14px; font-size: 17px; font-weight: bold; border-radius: 12px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-large:hover { transform: translateY(-2px); }

        /* Couleurs pour les actions */
        .btn-dark {
            background-color: var(--card-bg) !important;
            border-color: var(--card-bg) !important;
            color: var(--text-light) !important;
        }
        .btn-dark:hover {
            background-color: var(--bg-page) !important; 
            border-color: var(--bg-page) !important;
        }
        .btn-warning {
            background-color: #F3A600 !important;
            border-color: #F3A600 !important;
            color: var(--detail-card-text) !important;
        }
        .btn-warning:hover {
            background-color: #E29900 !important;
        }
        .btn-success {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
        }
        .btn-success:hover {
            background-color: #e65c5c !important;
        }
        
        /* Image */
        .img-fluid {
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
            border: 5px solid var(--card-bg);
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 18px !important;
            transition: border-color 0.3s;
        }
        
        /* Alertes (Flash messages) */
        .alert-success {
            background-color: #38c172;
            color: white;
            border: none;
            font-weight: 600;
            margin-bottom: 30px;
        }

    </style>
</head>
<body class="dark-mode">

<header class="topbar">
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

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('client.vehicles') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> Retour aux véhicules
    </a>

    <div class="row fade-in">

        <div class="col-md-6 mb-4">
            <img src="/storage/{{ $vehicle->image }}" 
                 alt="{{ $vehicle->brand }} {{ $vehicle->model }}"
                 class="img-fluid rounded shadow-lg">
        </div>

        <div class="col-md-6">
            <div class="vehicle-info">

                <h2 class="mb-4">{{ $vehicle->brand }} - {{ $vehicle->model }}</h2>

                <p class="text-muted">
                    Année : <b>{{ $vehicle->year }}</b> | Moteur : <b>V6</b> | Carburant : <b>Essence</b>
                </p>
                
                <hr>

                <p class="fw-bold fs-4 text-primary">
                    <i class="fas fa-tags"></i> Prix Vente : {{ number_format($vehicle->price) }} USD
                </p>

                <p class="fw-bold fs-5 text-success">
                    <i class="fas fa-dollar-sign"></i> Prix Location : {{ number_format($vehicle->loan_price) }} USD / jour
                </p>

                <p>
                    <span class="badge {{ $vehicle->status ? 'bg-success' : 'bg-secondary' }}">
                        <i class="fas fa-circle"></i> {{ $vehicle->status ? 'Disponible' : 'Indisponible' }}
                    </span>
                </p>

                <hr>

                <form method="POST" action="{{ route('client.cart.add', $vehicle->id) }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <button type="submit" class="btn btn-dark btn-large w-100" {{ $vehicle->status ? '' : 'disabled' }}>
                        🛒 Ajouter au Panier
                    </button>
                </form>

                <form method="POST" action="{{ route('client.loan.start', $vehicle->id) }}" class="mb-3">
                    @csrf
                    <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                    <input type="hidden" name="duration_days" value="1">
                    <button type="submit" class="btn btn-warning btn-large w-100" {{ $vehicle->status ? '' : 'disabled' }}>
                        🚗 Louer Maintenant
                    </button>
                </form>
                
                <form action="{{ route('client.purchase.start', $vehicle->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success w-100 btn-large">
                        Acheter ({{ number_format($vehicle->price) }} USD)
                    </button>
                </form>

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
