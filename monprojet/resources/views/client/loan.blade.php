<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Locations | AutoGestion</title>
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
            --primary-color: #FF6B6B; /* Corail Vif */
            --secondary-color: #4ECDC4; /* Cyan Vif pour l'action principale */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #161B22; /* Fond : Noir Profond */
            --card-bg: #1F2A37; /* Fond des cartes et Topbar */
            --topbar-height: 70px;
            --header-text-color: var(--primary-color);
            --table-header-bg: #1A232F;
            --table-hover-bg: #2C3E50;
            --table-border-color: #3d526a;
            
            /* Couleurs des Badges (Dark Mode) */
            --badge-actif-bg: #4ECDC4; 
            --badge-actif-text: #1F2A37; 
            --badge-termine-bg: #5a6b7d; /* Gris plus sobre pour terminé */
            --badge-termine-text: var(--text-light);
            --badge-annule-bg: #FF6B6B; 
            --badge-annule-text: var(--text-light);
        }

        /* =================================================================== */
        /* === 1.1 Variables Light Mode ====================================== */
        /* =================================================================== */
        .light-mode {
            --primary-color: #007bff; /* Bleu Primaire */
            --secondary-color: #28a745; /* Vert Secondaire */
            --text-light: #343a40; 
            --text-muted: #6c757d; 
            --bg-page: #f4f6f9; 
            --card-bg: #ffffff; 
            --header-text-color: var(--primary-color);
            --table-header-bg: var(--primary-color); 
            --table-hover-bg: #e2f0ff;
            --table-border-color: #dee2e6;
            
            /* Couleurs des Badges (Light Mode) */
            --badge-actif-bg: #28a745; /* Vert */
            --badge-actif-text: white; 
            --badge-termine-bg: #6c757d; /* Gris foncé */
            --badge-termine-text: white;
            --badge-annule-bg: #dc3545; /* Rouge Bootstrap */
            --badge-annule-text: white;
        }

        /* =================================================================== */
        /* === 2. Styles de Base (incluant les corrections de badges) ======== */
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


        /* Styles des Badges (Utilisation des variables pour une meilleure gestion) */
        .badge {
            font-weight: 600;
            padding: 0.5em 0.8em;
            border-radius: 50px;
            font-size: 0.85rem;
            min-width: 90px;
            display: inline-block;
            text-align: center;
        }

        .badge-actif {
            background-color: var(--badge-actif-bg) !important; 
            color: var(--badge-actif-text) !important;
        }

        .badge-termine {
            background-color: var(--badge-termine-bg) !important; 
            color: var(--badge-termine-text) !important;
        }

        .badge-annule {
            background-color: var(--badge-annule-bg) !important; 
            color: var(--badge-annule-text) !important;
        }


        /* =================================================================== */
        /* === 3. Styles Spécifiques Tableau Locations (Nettoyage) =========== */
        /* =================================================================== */
        .main-content {
            padding: 40px; 
            max-width: 1400px; /* Ajout d'une largeur maximale */
            margin: auto;
        }
        .main-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--header-text-color);
            margin-bottom: 30px;
            border-bottom: 3px solid var(--table-border-color);
            padding-bottom: 15px;
        }

        .table {
            background-color: var(--card-bg);
            border-radius: 15px;
            overflow: hidden; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            color: var(--text-light); 
        }
        .table > :not(caption) > * > * {
            padding: 1.2rem 1rem; /* Plus d'espace */
            border-color: var(--table-border-color);
        }
        .table-dark {
            --bs-table-bg: var(--table-header-bg); 
            --bs-table-color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        .light-mode .table-dark {
            --bs-table-color: white; 
        }

        .table-hover > tbody > tr:hover {
            --bs-table-accent-bg: var(--table-hover-bg); 
        }
        
        .alert-info {
            background-color: var(--card-bg); 
            border-color: var(--table-border-color); 
            color: var(--text-muted);
            font-size: 1.1rem;
            padding: 25px;
            border-radius: 15px;
        }

        /* Mise en forme spécifique des colonnes pour la lisibilité */
        .amount-col {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 1.05rem;
        }
        .date-col {
            font-size: 0.9rem;
            color: var(--text-muted);
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
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}" class="active"><i class="fas fa-key"></i> Locations</a>
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
<br>
<br>
<main class="main-content">

    <h2 class="mb-4">🔑 Mes Locations</h2>

    @if($loans->isEmpty())
        <div class="alert alert-info text-center shadow">
            <i class="fas fa-info-circle me-2"></i> Aucune location en cours ou passée enregistrée.
        </div>
    @else

    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered table-hover shadow-lg">
                    <thead class="table-dark">
                        <tr>
                            <th>Véhicule</th>
                            <th class="text-center">Durée</th>
                            <th class="text-end">Montant Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Date Début</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($loans as $loan)
                        <tr>
                            {{-- Véhicule --}}
                            <td class="align-middle fw-bold">{{ $loan->vehicle->brand }} - {{ $loan->vehicle->model }}</td>
                            
                            {{-- Durée --}}
                            <td class="align-middle text-center">{{ $loan->duration_days }} jours</td>
                            
                            {{-- Montant --}}
                            <td class="align-middle text-end amount-col">{{ number_format($loan->total_amount, 2, ',', ' ') }} USD</td>
                            
                            {{-- Status (avec badge coloré) --}}
                            <td class="align-middle text-center">
                                @php
                                    // Utilisation de la logique PHP pour déterminer la classe
                                    $statusClass = match ($loan->status) {
                                        'Actif' => 'badge-actif',
                                        'Terminé' => 'badge-termine',
                                        'Annulé' => 'badge-annule',
                                        default => 'bg-secondary', // Fallback
                                    };
                                @endphp
                                <span class="badge {{ $statusClass }}">{{ $loan->status }}</span> 
                            </td>
                            
                            {{-- Date --}}
                            <td class="align-middle text-center date-col">{{ \Carbon\Carbon::parse($loan->created_at)->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @endif
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
                body.classList.remove('dark-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon'); 
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.remove('light-mode');
                body.classList.add('dark-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun'); 
                localStorage.setItem('theme', 'dark');
            }
        };

        // 1. Charger le thème sauvegardé, sinon utiliser le thème sombre par défaut
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'light') {
            applyTheme(true);
        } else {
            // Par défaut, le body a la classe dark-mode, on s'assure que l'icône est correcte.
            applyTheme(false); 
        }

        // 2. Écouter le clic du bouton pour basculer
        toggleButton.addEventListener('click', () => {
            const isLight = body.classList.contains('light-mode');
            applyTheme(!isLight);
        });
    });
</script>
</body>
</html>