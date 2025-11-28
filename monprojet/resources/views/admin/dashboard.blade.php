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
            --shadow-light: rgba(255, 255, 255, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.5);
            --border-color: rgba(255, 255, 255, 0.1);
            --text-muted: #94a3b8;
        }

        /* === 1B. VARIABLES LIGHT MODE === */
        body.light-mode {
            --bg-color: #f7fafc; 
            --sidebar-bg: #ffffff; 
            --accent-color: #38bdf8; 
            --card-bg: #ffffff; 
            --text-color: #2d3748; 
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --border-color: rgba(0, 0, 0, 0.1);
            --text-muted: #6c757d; 
            background: var(--bg-color);
            animation: none;
            opacity: 1;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            transition: background 0.5s, color 0.5s;
            
            /* Styles d'animation Dark Mode */
            background: linear-gradient(135deg, #0f172a, #1e293b, #0d9488);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
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
            border-right: 1px solid var(--border-color);
        }

        .sidebar h1 {
            font-size: 22px;
            font-weight: 700;
            padding: 0 20px 20px;
            color: var(--accent-color);
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
        }

        .sidebar-nav a i {
            margin-right: 12px;
            font-size: 18px;
            width: 20px;
            text-align: center;
            color: inherit;
        }

        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--accent-color);
            color: var(--bg-color); 
            box-shadow: 0 4px 10px var(--shadow-dark);
        }
        
        .sidebar-nav a.active {
            font-weight: 600;
        }
        
        /* Styles de la Carte de Profil Admin */
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
        /* Fin des Styles de la Carte de Profil Admin */


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
        
        .stat-card i {
            font-size: 36px;
            margin-bottom: 10px;
            display: block;
            opacity: 0.8;
        }

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

        {{-- 1. Carte Utilisateurs --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-people-fill" style="color:#38bdf8;"></div>
                <i class="bi bi-people-fill" style="color:#38bdf8;"></i>
                <h5>Utilisateurs</h5>
                <h2>{{ $usersCount ?? 0 }}</h2>
                <small>Total des utilisateurs inscrits</small>
            </div>
        </div>

        {{-- 2. Carte Véhicules --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-car-front-fill" style="color:#4ade80;"></div>
                <i class="bi bi-car-front-fill" style="color:#4ade80;"></i>
                <h5>Véhicules</h5>
                <h2>{{ $vehiclesCount ?? 0 }}</h2>
                <small>Parc automobile enregistré</small>
            </div>
        </div>

        {{-- 3. Carte Transactions --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-receipt-cutoff" style="color:#fb923c;"></div>
                <i class="bi bi-receipt-cutoff" style="color:#fb923c;"></i>
                <h5>Transactions</h5>
                <h2>{{ $transactionsCount ?? 0 }}</h2>
                <small>Paiements & opérations effectuées</small>
            </div>
        </div>

        {{-- 4. Carte Locations --}}
        <div class="col-xl-3 col-md-6">
            <div class="stat-card">
                <div class="icon-bg bi bi-calendar-check-fill" style="color:#c084fc;"></div>
                <i class="bi bi-calendar-check-fill" style="color:#c084fc;"></i>
                <h5>Locations</h5>
                <h2>{{ $loansCount ?? 0 }}</h2>
                <small>Locations actives & historiques</small>
            </div>
        </div>
        
        {{-- 5. Carte Graphique (Activité Récente) --}}
        <div class="col-12 mt-4">
            <div class="card p-4" style="background: var(--card-bg); border: 1px solid var(--shadow-light); transition: background 0.5s, border-color 0.5s, box-shadow 0.5s;">
                <h4 class="text-center mb-4" style="color: var(--text-color);">Aperçu des 6 derniers mois</h4>
                <div style="height: 350px;"> 
                    <canvas id="monthlyActivityChart"></canvas>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ---------------------------------------------------- --}}
{{-- 💡 SECTION SCRIPT UNIQUE ET CORRIGÉE 💡 --}}
{{-- ---------------------------------------------------- --}}

{{-- Inclusions des librairies --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 

<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const toggleButton = document.getElementById('mode-toggle');
    const modeIcon = document.getElementById('mode-icon');
    let myChart = null; // Déclaration globale du graphique

    // --- CHART.JS LOGIC ---
    // Fonction pour mettre à jour les couleurs du graphique lors du changement de thème
    function updateChartColors() {
        // Lire les variables CSS en temps réel
        let primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--accent-color').trim(); 
        let textColor = getComputedStyle(document.documentElement).getPropertyValue('--text-color').trim();
        let gridColor = body.classList.contains('light-mode') ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)';

        if (myChart) {
             // Mise à jour des couleurs de configuration
             myChart.options.scales.y.grid.color = gridColor;
             myChart.options.scales.y.ticks.color = textColor;
             myChart.options.scales.x.ticks.color = textColor;
             myChart.options.plugins.legend.labels.color = textColor;
             myChart.data.datasets[0].backgroundColor = primaryColor + 'cc';
             myChart.data.datasets[0].borderColor = primaryColor;
             myChart.update();
        }
    }

    // Fonction pour créer le graphique initial
    function createChart() {
        const labels = ['Juin', 'Juillet', 'Août', 'Sept.', 'Oct.', 'Nov.'];
        const transactionData = [15, 20, 18, 25, 30, 22];
        const ctx = document.getElementById('monthlyActivityChart').getContext('2d');
        
        // Obtenir les couleurs initiales
        let initialTextColor = getComputedStyle(document.documentElement).getPropertyValue('--text-color').trim();
        let initialPrimaryColor = getComputedStyle(document.documentElement).getPropertyValue('--accent-color').trim();
        let initialGridColor = body.classList.contains('light-mode') ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)';

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Locations Terminées',
                    data: transactionData,
                    backgroundColor: initialPrimaryColor + 'cc',
                    borderColor: initialPrimaryColor,
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: initialGridColor, 
                            borderColor: initialTextColor
                        },
                        ticks: {
                            color: initialTextColor
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                         ticks: {
                            color: initialTextColor
                        }
                    }
                },
                plugins: {
                    legend: {
                        labels: {
                            color: initialTextColor
                        }
                    }
                }
            }
        });
    }

    // --- MODE TOGGLE LOGIC ---

    // 1. Initialisation au chargement
    const savedMode = localStorage.getItem('theme') || 'dark';

    if (savedMode === 'light') {
        body.classList.add('light-mode');
        modeIcon.classList.remove('bi-sun-fill');
        modeIcon.classList.add('bi-moon-fill');
    } else {
        body.classList.remove('light-mode');
        modeIcon.classList.add('bi-sun-fill');
        modeIcon.classList.remove('bi-moon-fill');
    }

    // Créer le graphique après l'initialisation du mode pour avoir les bonnes couleurs de départ
    createChart();


    // 2. Événement de bascule
    toggleButton.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        
        const isLightMode = body.classList.contains('light-mode');
        
        // Mise à jour de l'icône et du stockage local
        if (isLightMode) {
            modeIcon.classList.remove('bi-sun-fill');
            modeIcon.classList.add('bi-moon-fill');
            localStorage.setItem('theme', 'light');
        } else {
            modeIcon.classList.add('bi-sun-fill');
            modeIcon.classList.remove('bi-moon-fill');
            localStorage.setItem('theme', 'dark');
        }
        
        // Mettre à jour les couleurs du graphique après le changement de mode
        updateChartColors();
    });
});
</script>

</body>
</html>