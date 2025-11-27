<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Client | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    

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

            /* Variables spécifiques aux thèmes */
            --shadow-color: rgba(0, 0, 0, 0.3);
            --shadow-hover: rgba(0, 0, 0, 0.4);
            --card-border-color: transparent;
            --btn-logout-color: var(--bg-page);
        }

        /* =================================================================== */
        /* === 1.1 Variables Light Mode (Appliqué à la classe .light-mode) === */
        /* =================================================================== */
        .light-mode {
            --primary-color: #007bff; /* Bleu vif */
            --secondary-color: #28a745; /* Vert vif */
            --text-light: #343a40; /* Texte sombre */
            --text-muted: #6c757d; 
            --bg-page: #f8f9fa; /* Fond très clair */
            --card-bg: #ffffff; /* Fond des cartes blanc */
            
            /* Changement des ombres et bordures pour le mode clair */
            --shadow-color: rgba(0, 0, 0, 0.1);
            --shadow-hover: rgba(0, 0, 0, 0.15);
            --card-border-color: #e9ecef;
            --btn-logout-color: #fff;
        }

        /* =================================================================== */
        /* === 2. Styles de Base (Utilisation des Variables) ================= */
        /* =================================================================== */
        body {
            font-family: 'Poppins', 'Segoe UI', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light); 
            padding-top: var(--topbar-height);
            transition: background-color 0.3s, color 0.3s; /* Transition douce */
        }

        /* 3. Topbar (CORRIGÉE pour l'alignement) */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: 0 4px 15px var(--shadow-color);
            display: flex; /* Active Flexbox */
            align-items: center; /* Alignement vertical centré */
            justify-content: space-between; /* Espace les éléments */
            padding: 0 40px;
            position: fixed; /* Remplacé sticky par fixed */
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
            transition: background 0.3s;
        }
        
        .logo { 
            font-size: 22px; 
            font-weight: 700;
            color: var(--primary-color); 
            text-decoration: none;
            margin-right: 30px; 
            white-space: nowrap;
        }
        .logo i { color: var(--primary-color); margin-right: 5px; }

        .topbar-nav { 
            display: flex; 
            align-items: center; 
            flex-grow: 1; /* Permet à la navigation de prendre l'espace restant */
        }
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
            white-space: nowrap;
        }

        .topbar-nav a:hover, .topbar-nav a.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }
        
        /* Conteneur des actions (boutons) */
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px; /* Espacement entre le bouton de thème et le bouton de déconnexion */
        }

        /* Bouton de Déconnexion (Vif sur fond sombre) */
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
            color: var(--btn-logout-color); /* S'adapte au mode clair/sombre */
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.4);
        }
        
        /* Bouton de bascule de thème */
        .btn-theme-toggle {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        /* 4. Contenu Principal et Titres */
        .main-content {
            padding: 40px; /* J'ai ajusté le padding pour un meilleur espacement */
        }
        
        .page-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto 40px auto;
        }
        
        .page-header h2 {
            color: var(--primary-color); /* Le titre principal utilise la couleur d'accentuation */
        }
        
        .page-header p {
            color: var(--text-muted);
        }

        /* 5. Cartes (Visibles et Contraste sur Fond Sombre/Clair) */
        .stat-card {
            background: var(--card-bg); 
            border-radius: 12px;
            box-shadow: 0 10px 30px var(--shadow-color); 
            padding: 30px; 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: 1px solid var(--card-border-color); /* Nouvelle bordure pour le mode clair */
            position: relative;
            text-align: center;
            overflow: hidden;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-5px); 
            box-shadow: 0 18px 45px var(--shadow-hover); 
            border-bottom: 4px solid var(--primary-color); /* Bordure en bas pour l'effet */
        }

        .stat-card h5 {
            color: var(--text-muted);
            text-transform: uppercase;
        }

        .stat-card h2 {
            font-size: 3rem; 
            font-weight: 800;
            color: var(--text-light); /* Les nombres sont clairs dans tous les cas, mais la couleur du mode clair sera utilisée dans ce mode */
        }
        
        /* Couleurs Thématiques Spécifiques aux Nombres */
        .stat-card:nth-child(1) h2 { color: var(--primary-color); }
        .stat-card:nth-child(2) h2 { color: #2ecc71; }
        .stat-card:nth-child(3) h2 { color: #f39c12; }
        .stat-card:nth-child(4) h2 { color: var(--secondary-color); }

        /* Icone flottante en fond */
        .stat-card-icon {
            font-size: 2.8rem;
            opacity: 0.1;
            position: absolute;
            top: 20px;
            right: 50%;
            transform: translateX(50%);
            color: var(--primary-color);
            transition: all 0.5s ease;
        }
        
        /* Animations (maintenues) */
        .card-animation { opacity: 0; transform: translateY(20px); animation: fadeInSlide 0.5s ease-out forwards; }
        .row.g-5 > .col-md-3 { display: flex; }
        @keyframes fadeInSlide { to { opacity: 1; transform: translateY(0); } }
        @keyframes slideIn { from { transform: translateY(10px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    </style>
</head>
<body>

<header class="topbar">
    <a  class="logo">
       AutoGestion
    </a>
    
    <nav class="topbar-nav">
        <a href="{{ route('client.dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('client.about') }}"><i class="fas fa-info-circle"></i> À Propos</a>
        <a href="{{ route('client.contact') }}"><i class="fas fa-headset"></i> Contact</a> 
    </nav>
    
    <div class="topbar-actions">
        
        {{-- NOUVEAU BOUTON DE BASCULE DE THÈME --}}
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
    <div class="page-header">
    <h2>Bienvenue, {{ $userName ?? 'cher client' }} !</h2>
        <br>
        <p>Toutes vos données sont à portée de main. Commencez par explorer vos statistiques ci-dessous.</p>
    </div>

    <div class="row g-5 justify-content-center"> 
        
        <div class="col-md-3">
            <div class="stat-card card-animation">
                <i class="fas fa-shopping-basket stat-card-icon"></i>
                <h5>VÉHICULES PANIER</h5>
                <h2>{{ $cartCount }}</h2>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card card-animation" style="animation-delay: 0.2s;">
                <i class="fas fa-road stat-card-icon"></i>
                <h5>LOCATIONS ACTIVES</h5>
                <h2>{{ $loanCount }}</h2>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card card-animation" style="animation-delay: 0.3s;">
                <i class="fas fa-receipt stat-card-icon"></i>
                <h5>TRANSACTIONS</h5>
                <h2>{{ $transactionCount }}</h2>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stat-card stat-card-total card-animation" style="animation-delay: 0.4s;">
                <i class="fas fa-money-bill-wave stat-card-icon"></i>
                <h5>DÉPENSE TOTALE</h5>
                <h2>{{ number_format($totalSpent) }} USD</h2>
            </div>
        </div>
        
    </div>
    
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('theme-toggle');
        const body = document.body;
        const icon = toggleButton.querySelector('i');

        // Fonction pour appliquer le thème
        const applyTheme = (isLight) => {
            if (isLight) {
                body.classList.add('light-mode');
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon'); // Afficher la lune pour basculer vers le Dark Mode
                localStorage.setItem('theme', 'light');
            } else {
                body.classList.remove('light-mode');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun'); // Afficher le soleil pour basculer vers le Light Mode
                localStorage.setItem('theme', 'dark');
            }
        };

        // 1. Chargement initial : Vérifier le thème sauvegardé
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'light') {
            applyTheme(true);
        } else {
            // Dark Mode par défaut si rien n'est sauvegardé ou si c'est 'dark'
            applyTheme(false); 
        }

        // 2. Événement du bouton
        toggleButton.addEventListener('click', () => {
            // Basculer le thème actuel
            const isLight = body.classList.contains('light-mode');
            applyTheme(!isLight);
        });
    });
</script>
</body>
</html>