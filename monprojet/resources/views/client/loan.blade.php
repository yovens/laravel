<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Locations | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            --primary-color: #FF6B6B; /* Corail Vif */
            --secondary-color: #4ECDC4; /* Cyan Vif */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #1F2937; /* Fond : Bleu Nuit Profond */
            --card-bg: #2C3E50; /* Fond des cartes et Topbar (Sombre) */
            --topbar-height: 65px;
            --header-text-color: var(--primary-color);
            --table-header-bg: #1A232F;
            --table-hover-bg: #3d526a;
            --table-border-color: #3d526a;
            --badge-termine-bg: #5a6b7d;
        }

        /* =================================================================== */
        /* === 1.1 Variables Light Mode ====================================== */
        /* =================================================================== */
        .light-mode {
            --primary-color: #007bff; /* Bleu Primaire */
            --secondary-color: #28a745; /* Vert Secondaire */
            --text-light: #343a40; /* Texte sombre */
            --text-muted: #6c757d; 
            --bg-page: #f8f9fa; /* Fond : Très clair */
            --card-bg: #ffffff; /* Fond Topbar/Card Clair */
            --header-text-color: var(--primary-color);
            --table-header-bg: var(--primary-color); 
            --table-hover-bg: #e2f0ff;
            --table-border-color: #dee2e6;
            --badge-termine-bg: #6c757d;
        }

        /* Styles de base */
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light);
            padding-top: var(--topbar-height); 
            transition: background-color 0.3s, color 0.3s;
        }
        .badge-actif {
    background-color: var(--secondary-color) !important; 
    color: #1F2937 !important; /* texte foncé pour contraste */
}

.badge-termine {
    background-color: var(--badge-termine-bg) !important; 
    color: #1beb25ff  eny; /* texte clair sur fond sombre */
}

.badge-annule {
    background-color: var(--primary-color) !important; 
    color: #d20d0dff ; /* texte clair sur fond rouge */
}

/* Mode clair */
.light-mode .badge-actif {
    color: #666 ; 
}

.light-mode .badge-termine {
    color: #343a40 !important; 
}

.light-mode .badge-annule {
    color: #343a40 !important; 
}

        /* =================================================================== */
        /* === 2. Topbar (Navigation) ======================================== */
        /* =================================================================== */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg); /* Adaptatif */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            display: flex;
            align-items: center;
            justify-content: space-between; /* Pour séparer logo/nav et actions */
            padding: 0 40px;
            position: fixed; 
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
            transition: background 0.3s, box-shadow 0.3s;
        }
        .logo { font-size: 22px; font-weight: 700; color: var(--primary-color); text-decoration: none; margin-right: 40px; transition: color 0.3s; }
        .logo i { color: var(--primary-color); margin-right: 5px; }
        .topbar-nav { margin-right: auto; display: flex; align-items: center; }
        .topbar-nav a {
            color: var(--text-muted);
            font-weight: 500;
            padding: 8px 15px;
            text-decoration: none;
            transition: color 0.3s, border-bottom 0.3s;
            border-bottom: 3px solid transparent;
            margin: 0 5px;
            font-size: 0.95rem;
            display: inline-flex;
            align-items: center;
            gap: 6px; 
        }
        .topbar-nav a:hover, .topbar-nav a.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }
        
        .topbar-actions { display: flex; align-items: center; gap: 15px; } /* Conteneur des actions (logout + toggle) */

        .btn-logout {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background-color: transparent;
            padding: 6px 15px; 
            font-size: 0.9rem;
            border-radius: 6px;
            transition: all 0.2s;
            text-transform: uppercase;
        }
        .btn-logout:hover {
            background-color: var(--primary-color);
            color: var(--bg-page);
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.4);
        }

        /* Bouton de bascule de thème */
        .btn-theme-toggle {
            background: none; border: none; color: var(--text-muted); font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover { color: var(--primary-color); transform: scale(1.1); }
        .light-mode .btn-theme-toggle { color: var(--text-muted); }
        .light-mode .btn-theme-toggle:hover { color: var(--primary-color); }
        
        /* =================================================================== */
        /* === 3. Styles Spécifiques Tableau Locations (Adaptatif) =========== */
        /* =================================================================== */
        .main-content {
            padding: 40px 40px 80px 40px;
        }
        .main-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--header-text-color); /* Adaptatif */
            margin-bottom: 30px;
            border-bottom: 3px solid var(--table-border-color); /* Adaptatif */
            padding-bottom: 15px;
            transition: color 0.3s, border-color 0.3s;
        }

        /* Tableau Adaptatif */
        .table {
            background-color: var(--card-bg); /* Adaptatif */
            border-radius: 15px;
            overflow: hidden; 
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            color: var(--text-light); 
            transition: background-color 0.3s;
        }
        .table > :not(caption) > * > * {
            padding: 1rem 1rem;
            border-bottom-width: 1px;
            border-color: var(--table-border-color); /* Adaptatif */
            transition: border-color 0.3s;
        }
        .table-dark {
            --bs-table-bg: var(--table-header-bg); /* Adaptatif */
            --bs-table-color: var(--text-light);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        /* Mode clair: Texte de l'en-tête en blanc pour mieux contraster avec l'en-tête coloré */
        .light-mode .table-dark {
            --bs-table-color: white; 
        }

        .table-hover > tbody > tr:hover {
            --bs-table-accent-bg: var(--table-hover-bg); /* Adaptatif */
        }

    

        /* Message d'alerte (Pas de locations) */
        .alert-info {
            background-color: var(--card-bg); /* Adaptatif */
            border-color: var(--table-border-color); /* Adaptatif */
            color: var(--text-muted);
            font-size: 1.1rem;
            padding: 25px;
            border-radius: 15px;
            transition: background-color 0.3s, border-color 0.3s;
        }

    
        /* Le texte doit être clair sur le fond rouge/bleu */
        .light-mode .badge-annule {
            color: white !important;
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
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}" class="active"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('client.about') }}"><i class="fas fa-info-circle"></i> À Propos</a>
        <a href="{{ route('client.contact') }}"><i class="fas fa-headset"></i> Contact</a> 
    </nav>
    
    <div class="topbar-actions">
        {{-- Bouton de Bascule de Thème --}}
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
<br>
<br>
<main class="main-content">

    <h2 class="mb-4">🔑 Mes Locations</h2>
<br>
    @if($loans->isEmpty())
        <div class="alert alert-info text-center shadow">
            Aucune location en cours ou passée enregistrée.
        </div>
    @else

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover shadow-lg">
                <thead class="table-dark">
                    <tr>
                        <th>Véhicule</th>
                        <th>Durée</th>
                        <th>Montant</th>
                        <th>Status</th>
                        <th>Date Début</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($loans as $loan)
                    <tr>
                        {{-- Véhicule --}}
                        <td class="align-middle fw-bold">{{ $loan->vehicle->brand }} - {{ $loan->vehicle->model }}</td>
                        
                        {{-- Durée --}}
                        <td class="align-middle">{{ $loan->duration_days }} jours</td>
                        
                        {{-- Montant --}}
                        <td class="align-middle fw-bold">{{ number_format($loan->total_amount) }} USD</td>
                        
                        {{-- Status (avec badge coloré) --}}
                        <td class="align-middle" style="color: red";>
                            @php
                                $statusClass = '';
                                if ($loan->status === 'Actif') {
                                    $statusClass = 'badge-actif';
                                } elseif ($loan->status === 'Terminé') {
                                    $statusClass = 'badge-termine';
                                } elseif ($loan->status === 'Annulé') {
                                    $statusClass = 'badge-annule';
                                }
                            @endphp
                            {{-- RETRAIT DU STYLE EN LIGNE INCORRECT --}}
                            <span class="badge {{ $statusClass }}">{{ $loan->status }}</span> 
                        </td>
                        
                        {{-- Date --}}
                        <td class="align-middle text-muted">{{ $loan->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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







