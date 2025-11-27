<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Locations - AutoGestion Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* === 1. VARIABLES & FOND (Dark Mode Admin) === */
        :root {
            --sidebar-width: 260px;
            --bg-color: #1a202c; /* Fond principal sombre */
            --sidebar-bg: #2d3748; /* Fond Sidebar légèrement plus clair */
            --accent-color: #38bdf8; /* Couleur d'accent générale (Dashboard) */
            --loan-accent: #a78bfa; /* Couleur d'accent spécifique (Violet) */
            --card-bg: rgba(45, 55, 72, 0.8); /* Fond Card translucide */
            --text-color: #e2e8f0;
            --link-hover: #ffffff;
            --shadow-light: rgba(255, 255, 255, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.5);
            --border-color: rgba(255, 255, 255, 0.1);
        }

        /* === 1B. VARIABLES LIGHT MODE (AJOUTÉ) === */
        body.light-mode {
            --bg-color: #f7fafc; 
            --sidebar-bg: #ffffff; 
            --card-bg: #ffffff; 
            --text-color: #2d3748; /* Texte sombre (CLÉ !) */
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --border-color: rgba(0, 0, 0, 0.15);
            --link-color: #4a5568;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex; /* Active le layout flex pour la sidebar/content */
            min-height: 100vh;
            transition: background 0.5s, color 0.5s; /* Ajouté */
        }

        /* ==== 2. SIDEBAR (Navigation Latérale) ==== */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            padding: 20px 0;
            box-shadow: 4px 0 10px var(--shadow-dark);
            transition: width 0.3s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
        }

        .sidebar h1 {
            font-size: 22px;
            font-weight: 700;
            padding: 0 20px 20px;
            color: var(--loan-accent);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 20px;
        }

        .sidebar-nav {
            flex-grow: 1;
        }

        .sidebar-nav a {
            display: block;
            padding: 12px 20px;
            margin: 5px 15px;
            border-radius: 8px;
            color: var(--text-color);
            text-decoration: none;
            transition: 0.3s;
            font-weight: 500;
            position: relative;
        }

        /* Style pour le Light Mode */
        body.light-mode .sidebar-nav a {
             color: var(--link-color);
        }

        .sidebar-nav a i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
        }

        /* Accentuation pour le lien Locations (Violet) */
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--loan-accent);
            color: var(--bg-color); 
            box-shadow: 0 4px 10px rgba(167, 139, 250, 0.4);
        }
        
        .sidebar-nav a.active {
            font-weight: 600;
        }

        /* ==== 3. CONTENU PRINCIPAL ==== */
        .content-area {
            margin-left: var(--sidebar-width);
            flex-grow: 1;
            padding: 30px 40px;
            transition: margin-left 0.3s;
        }
        
        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .content-header h2 {
            font-weight: 800;
            color: var(--loan-accent); /* Utilisation de l'accent Violet */
        }
        
        .intro {
            font-size: 16px;
            opacity: 0.85;
            max-width: 900px;
            margin-bottom: 40px;
            padding-left: 0;
        }

        /* Style pour le bouton Mode Toggle (AJOUTÉ) */
        #mode-toggle {
            cursor: pointer;
            background: var(--sidebar-bg);
            border: 1px solid var(--border-color);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: background 0.3s, border-color 0.3s, color 0.3s;
            color: var(--text-color);
        }
        #mode-toggle:hover {
            background: var(--loan-accent);
            color: var(--bg-color);
            border-color: var(--loan-accent);
        }


        /* TABLE CUSTOM STYLES (CORRIGÉ) */
        .table-dark thead th {
            color: var(--bg-color); 
            background-color: var(--loan-accent); /* En-tête de tableau Violet */
            border-color: rgba(0,0,0,0.2);
        }
        
        .table-dark {
             /* Mode Sombre (Dark Mode) par défaut 
             --bs-table-bg: var(--sidebar-bg); */
             --bs-table-hover-bg: rgba(255, 255, 255, 0.1);
             border-color: rgba(255, 255, 255, 0.1);
             color: var(--text-color); /* CLÉ: Définit la couleur du texte via la variable */
        }

        /* Light Mode Table adjustments (AJOUTÉ) */
        body.light-mode .table-dark {
           /*  --bs-table-bg: var(--card-bg); */
            --bs-table-hover-bg: #f0f0f0;
            color: var(--text-color); /* CLÉ: Assure que le texte est sombre (noir) */
            border-color: var(--border-color);
        }
        body.light-mode .table-dark thead th {
            color: #fff; /* Le texte de l'en-tête reste blanc sur le fond d'accent violet */
        }
        body.light-mode .table-dark tr {
            border-color: var(--border-color) !important;
        }

        /* Styles supplémentaires pour le Light Mode */
        body.light-mode .text-muted {
            color: #6c757d !important; /* Pour les ID en Light Mode */
        }

        /* ==== 5. BOUTON LOGOUT ==== */
        .logout-btn {
            padding: 8px 20px;
            border-radius: 8px;
            border: none;
            background: #ef4444; 
            color: white;
            transition: 0.3s ease;
            font-weight: 600;
            margin-top: 15px;
            width: 100%;
            text-align: center;
        }

        .logout-btn:hover {
            background: #dc2626;
            transform: scale(1.02);
        }
    </style>
</head>

<body>

<div class="sidebar">
    <br>
    <br>
    <h1><i class="bi bi-gear-fill me-2"></i> AutoGestion </h1>
<br>
    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
        <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Utilisateurs</a>
        <a href="{{ route('admin.vehicles.index') }}"><i class="bi bi-car-front-fill"></i> Véhicules</a>
        <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt"></i> Transactions</a>
        <a href="{{ route('admin.loans.index') }}" class="active"><i class="bi bi-calendar-check"></i> Locations</a>
         <a href="{{ route('admin.profile') }}" ><i class="bi bi-person-badge"></i> Mon Profil</a>
    </div>

    {{-- Bouton de Déconnexion en bas de la sidebar --}}
    <div style="padding: 0 15px 20px;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="logout-btn">
                <i class="bi bi-box-arrow-right"></i> Déconnexion
            </button>
        </form>
    </div>
</div>


<div class="content-area">
<br>
<br>
    <div class="content-header">
        <h2 class="fw-bold"><i class="bi bi-calendar-check me-2"></i> Gestion des Locations</h2>
        
        <div class="d-flex align-items-center gap-3">
            {{-- Bouton de changement de mode (AJOUTÉ) --}}
            <button id="mode-toggle" title="Changer de Mode">
                <i class="bi bi-sun-fill" id="mode-icon"></i>
            </button>
            <p class="mb-0 text-muted d-none d-md-block"><i class="bi bi-calendar"></i> Aujourd'hui : {{ date('d F Y') }}</p>
        </div>
    </div>

    <p class="intro">
        Gérez toutes les demandes de location de véhicules, y compris l'approbation et le suivi des statuts.
    </p>

    {{-- TABLEAU DE GESTION (DARK MODE) --}}
    <div class="table-responsive shadow-lg rounded" style="border-radius: 12px; overflow: hidden; background: var(--card-bg); border: 1px solid var(--shadow-light);">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Véhicule</th>
                    <th>Durée (jours)</th>
                    <th>Montant</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($loans as $loan)
                <tr style="border-color: var(--border-color);">
                    <td class="text-muted">{{ $loan->id }}</td>
                    <td>{{ $loan->user->nom }}</td>
                    <td>{{ $loan->vehicle->brand }} {{ $loan->vehicle->model }}</td>
                    <td>{{ $loan->duration_days }}</td>
                    <td><span class="badge bg-secondary">{{ number_format($loan->total_amount) }} USD</span></td>
                    <td>
                        @if($loan->status=='pending')
                            <span class="badge bg-warning text-dark">En attente</span>
                        @elseif($loan->status=='approved')
                            <span class="badge bg-success">Approuvé</span>
                        @else
                            <span class="badge bg-danger">Refusé</span>
                        @endif
                    </td>
                    <td>{{ $loan->created_at }}</td>
                    <td>
                        {{-- NOTE: Les actions d'approbation/refus peuvent être ajoutées ici --}}
                        <form method="POST" action="{{ route('admin.loans.destroy',$loan->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Supprimer la location">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- SCRIPT DE GESTION DE MODE (AJOUTÉ) --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const toggleButton = document.getElementById('mode-toggle');
    const modeIcon = document.getElementById('mode-icon');
    
    // 1. Détermine le mode par défaut au chargement
    // On utilise la même clé 'theme' pour que le mode soit persistant sur toutes les pages de l'Admin
    const savedMode = localStorage.getItem('theme') || 'dark'; 

    function setMode(mode) {
        if (mode === 'light') {
            body.classList.add('light-mode');
            modeIcon.classList.remove('bi-sun-fill');
            modeIcon.classList.add('bi-moon-fill');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.remove('light-mode');
            modeIcon.classList.add('bi-sun-fill');
            modeIcon.classList.remove('bi-moon-fill');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Appliquer le mode sauvegardé
    setMode(savedMode);

    // 2. Événement de bascule
    toggleButton.addEventListener('click', () => {
        const currentMode = body.classList.contains('light-mode') ? 'light' : 'dark';
        const newMode = currentMode === 'light' ? 'dark' : 'light';
        setMode(newMode);
    });
});
</script>

</body>
</html>