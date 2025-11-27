<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* === 1. VARIABLES (Dark Mode par défaut) === */
        :root {
            --sidebar-width: 260px;
            --bg-color: #1a202c; /* Fond principal sombre */
            --sidebar-bg: #2d3748; /* Fond Sidebar légèrement plus clair */
            --accent-color: #38bdf8; /* Bleu Ciel */
            --card-bg: rgba(45, 55, 72, 0.8); /* Fond Card translucide */
            --text-color: #e2e8f0;
            --link-hover: #ffffff;
            --shadow-light: rgba(255, 255, 255, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.5);
            --border-color: rgba(255, 255, 255, 0.1);
            --text-muted: #94a3b8; /* Ajout d'une couleur pour le rôle */
        }

        /* === 1B. VARIABLES LIGHT MODE === */
        body.light-mode {
            --bg-color: #f7fafc; /* Fond clair */
            --sidebar-bg: #ffffff; /* Sidebar blanc */
            --accent-color: #38bdf8; /* Garde l'accent bleu */
            --card-bg: #ffffff; /* Fond Card blanc opaque */
            --text-color: #2d3748; /* Texte sombre */
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --border-color: rgba(0, 0, 0, 0.1);
            --text-muted: #6c757d; 
        }
        
        /* Reset de l'animation de fond pour le mode clair (optionnel) */
        body.light-mode {
            background: var(--bg-color); /* Retirez l'animation de gradient */
            animation: none;
            opacity: 1;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            transition: background 0.5s, color 0.5s; /* Transition fluide */
            
            /* Styles d'animation Dark Mode */
            background: linear-gradient(135deg, #0f172a, #1e293b, #0d9488);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            z-index: -1;
            opacity: 0.95;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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
            transition: all 0.5s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color); /* Mise à jour de la bordure */
        }

        .sidebar h1 {
            font-size: 22px;
            font-weight: 700;
            padding: 0 20px 20px;
            color: var(--accent-color);
            border-bottom: 1px solid var(--border-color); /* Mise à jour de la bordure */
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

        .sidebar-nav a i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
            color: inherit; /* Assure que la couleur suit le lien */
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--accent-color);
            color: var(--bg-color); 
            box-shadow: 0 4px 10px var(--shadow-dark);
        }
        
        .sidebar-nav a.active {
            font-weight: 600;
        }
        
        /* ==== AJOUT : Styles de la Carte de Profil Admin ==== */
        .admin-profile {
            padding: 15px 20px 25px;
            margin-bottom: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            border-top: 3px solid var(--accent-color); 
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            object-fit: cover;
            border: 3px solid var(--accent-color);
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.5); 
        }
        
        /* Light Mode : Ajustement de l'ombre pour le profil */
        body.light-mode .profile-pic {
            box-shadow: 0 0 10px rgba(56, 189, 248, 0.3); 
        }


        .admin-profile h4 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 3px;
        }

        .admin-profile p {
            font-size: 0.85rem;
            color: var(--text-muted); 
            opacity: 0.7;
            margin-bottom: 0;
        }
        /* === Fin des Styles de la Carte de Profil Admin === */


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
            border-bottom: 1px solid var(--border-color); 
            padding-bottom: 15px;
        }

        .content-header h2 {
            font-weight: 800;
            color: var(--accent-color);
        }
        
        .intro {
            font-size: 16px;
            opacity: 0.85;
            max-width: 900px;
            margin-bottom: 40px;
            padding-left: 0; 
        }

        /* ==== 4. CARDS ==== */
        .stat-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 25px;
            text-align: left;
            color: var(--text-color);
            border: 1px solid var(--shadow-light);
            box-shadow: 0 4px 15px var(--shadow-dark); 
            transition: 0.35s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px var(--shadow-dark);
            background: var(--sidebar-bg);
        }
        
        /* Couleurs pour les icônes de carte (basé sur le Dark Mode) */
        .stat-card i {
            font-size: 36px;
            margin-bottom: 10px;
            display: block;
            opacity: 0.8;
        }

        /* Couleurs des icônes de cartes en LIGHT MODE */
        body.light-mode .stat-card i {
             opacity: 1; 
        }

        .stat-card .icon-bg {
            position: absolute;
            top: -15px;
            right: -15px;
            font-size: 80px;
            opacity: 0.08;
            z-index: 0;
        }

        /* ==== 5. BOUTON LOGOUT & MODE TOGGLE ==== */
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
        .logout-btn:hover { background: #dc2626; transform: scale(1.02); }

        /* Style pour le bouton Mode Toggle */
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
            background: var(--accent-color);
            color: var(--bg-color);
            border-color: var(--accent-color);
        }
    </style>
</head>

<body>

<div class="sidebar">
  
    <h1><i class="bi bi-gear-fill me-2"></i> AutoGestion</h1>
    
    {{-- 💡 NOUVELLE CARTE DE PROFIL ADMIN 💡 --}}
    <div class="admin-profile">
 
      
      <h4>{{ $adminName ?? 'Administrateur' }}</h4>
        <p>Admin Principal</p>
    </div>
    {{-- Fin de la Carte de Profil Admin --}}


    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}" class="active"><i class="bi bi-speedometer"></i> Dashboard</a>
        <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Utilisateurs</a>
        <a href="{{ route('admin.vehicles.index') }}"><i class="bi bi-car-front-fill"></i> Véhicules</a>
        <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt"></i> Transactions</a>
        <a href="{{ route('admin.loans.index') }}"><i class="bi bi-calendar-check"></i> Locations</a>
            <a href="{{ route('admin.profile') }}" class="active"><i class="bi bi-person-badge"></i> Mon Profil</a>
    </div>

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
          <h2>Bienvenue, {{ $adminName ?? 'Administrateur' }} 👋</h2>
        
        <div class="d-flex align-items-center gap-3">
            {{-- Bouton de changement de mode --}}
            <button id="mode-toggle" title="Changer de Mode">
                <i class="bi bi-sun-fill" id="mode-icon"></i>
            </button>
            <p class="mb-0 text-muted d-none d-md-block"> <i class="bi bi-calendar"></i> Aujourd'hui : {{ date('d F Y') }}</p>
        </div>
    </div>

    <p class="intro">
        Surveillez en temps réel les performances, les activités et l’état global de votre plateforme.
        Ce tableau de bord vous permet de gérer efficacement vos clients, vos véhicules et vos opérations.
    </p>

    <div class="row g-4">

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-people-fill" style="color:#38bdf8;"></div>
                <i class="bi bi-people-fill" style="color:#38bdf8;"></i>
                <h5>Utilisateurs</h5>
                <h2>{{ $usersCount }}</h2>
                <small>Total des utilisateurs inscrits</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-car-front-fill" style="color:#4ade80;"></div>
                <i class="bi bi-car-front-fill" style="color:#4ade80;"></i>
                <h5>Véhicules</h5>
                <h2>{{ $vehiclesCount }}</h2>
                <small>Parc automobile enregistré</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-receipt-cutoff" style="color:#fb923c;"></div>
                <i class="bi bi-receipt-cutoff" style="color:#fb923c;"></i>
                <h5>Transactions</h5>
                <h2>{{ $transactionsCount }}</h2>
                <small>Paiements & opérations effectuées</small>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-calendar-check-fill" style="color:#c084fc;"></div>
                <i class="bi bi-calendar-check-fill" style="color:#c084fc;"></i>
                <h5>Locations</h5>
                <h2>{{ $loansCount }}</h2>
                <small>Locations actives & historiques</small>
            </div>
        </div>
        
        <div class="col-12 mt-4">
              <div class="card p-4" style="background: var(--card-bg); border: 1px solid var(--shadow-light); transition: background 0.5s, border-color 0.5s, box-shadow 0.5s;">
                   <h4 class="text-center" style="color: var(--text-color);">Aperçu de l'activité récente</h4>
                   <p class="text-center text-muted">Intégrez ici vos graphiques ou listes d'activités.</p>
              </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const toggleButton = document.getElementById('mode-toggle');
    const modeIcon = document.getElementById('mode-icon');
    
    // 1. Détermine le mode par défaut au chargement
    const savedMode = localStorage.getItem('theme') || 'dark';

    if (savedMode === 'light') {
        body.classList.add('light-mode');
        modeIcon.classList.remove('bi-sun-fill');
        modeIcon.classList.add('bi-moon-fill');
    } else {
        // Assure que le mode sombre est le mode par défaut si rien n'est sauvegardé
        body.classList.remove('light-mode');
        modeIcon.classList.add('bi-sun-fill');
        modeIcon.classList.remove('bi-moon-fill');
    }

    // 2. Événement de bascule
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        
        const isLightMode = body.classList.contains('light-mode');
        
        // Mise à jour de l'icône
        if (isLightMode) {
            modeIcon.classList.remove('bi-sun-fill');
            modeIcon.classList.add('bi-moon-fill');
            localStorage.setItem('theme', 'light');
        } else {
            modeIcon.classList.add('bi-sun-fill');
            modeIcon.classList.remove('bi-moon-fill');
            localStorage.setItem('theme', 'dark');
        }
    });
});
</script>

</body>
</html>