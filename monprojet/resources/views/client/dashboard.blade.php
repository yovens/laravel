<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Client | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap & Font Awesome (fa-v6) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    {{-- Police Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            --primary-color: #FF6B6B; /* Rouge Corail Vif */
            --secondary-color: #4ECDC4; /* Cyan/Vert d'eau */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #161B22; /* Fond très sombre */
            --card-bg: #1F2A37; /* Fond des cartes */
            --topbar-height: 70px;

            /* Ombres et Bordures */
            --shadow-color: rgba(0, 0, 0, 0.4);
            --shadow-hover: rgba(0, 0, 0, 0.6);
            --card-border-color: rgba(255, 255, 255, 0.08);
            --btn-logout-color: var(--bg-page);
        }

        /* =================================================================== */
        /* === 1.1 Variables Light Mode (Appliqué à la classe .light-mode) === */
        /* =================================================================== */
        .light-mode {
            --primary-color: #007bff; 
            --secondary-color: #28a745; 
            --text-light: #343a40; 
            --text-muted: #6c757d; 
            --bg-page: #f4f6f9; 
            --card-bg: #ffffff; 
            
            --shadow-color: rgba(0, 0, 0, 0.1);
            --shadow-hover: rgba(0, 0, 0, 0.15);
            --card-border-color: #e9ecef;
            --btn-logout-color: #fff;
        }

        /* =================================================================== */
        /* === 2. Styles de Base ============================================= */
        /* =================================================================== */
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light); 
            padding-top: var(--topbar-height);
            transition: background-color 0.4s, color 0.4s;
        }
        
        /* 3. Topbar */
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
        
        /* Boutons d'Action */
        .btn-logout {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background-color: transparent;
            padding: 8px 18px; 
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 6px;
            transition: all 0.2s;
        }
        .btn-logout:hover {
            background-color: var(--primary-color);
            color: white; 
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.6);
            transform: scale(1.02);
        }
        
        /* Bouton de bascule de thème */
        .btn-theme-toggle {
            background: none;
            border: none;
            color: var(--primary-color); 
            font-size: 1.5rem;
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover {
            color: var(--secondary-color);
            transform: scale(1.1);
        }

        /* 4. Contenu Principal et Titres */
        .main-content {
            padding: 40px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .page-header {
            text-align: left;
            margin-bottom: 50px;
            padding-left: 15px;
        }
        
        .page-header h2 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 5px;
            /* Effet de texte dégradé */
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .page-header p {
            font-size: 1.1rem;
            color: var(--text-muted);
        }

        /* 5. Cartes de Statistiques */
        .stat-card, .secondary-content-card {
            background: var(--card-bg); 
            border-radius: 12px;
            box-shadow: 0 8px 25px var(--shadow-color); 
            padding: 30px; 
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            border: 1px solid var(--card-border-color);
            position: relative;
            height: 100%;
        }
        .stat-card {
             text-align: left;
             overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-8px); 
            box-shadow: 0 15px 40px var(--shadow-hover); 
        }

        .stat-card h5 {
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 1px;
            margin-bottom: 15px;
        }

        .stat-card h2 {
            font-size: 2.8rem; 
            font-weight: 900;
            line-height: 1;
        }
        
        /* Couleurs Thématiques Spécifiques aux Nombres */
        .stat-card:nth-child(1) h2 { color: var(--primary-color); }
        .stat-card:nth-child(2) h2 { color: #2ecc71; }
        .stat-card:nth-child(3) h2 { color: #f39c12; }
        .stat-card:nth-child(4) h2 { color: var(--secondary-color); }

        /* Icone flottante en fond */
        .stat-card-icon {
            font-size: 5rem;
            opacity: 0.05;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            transition: all 0.5s ease;
        }
        .stat-card:hover .stat-card-icon { opacity: 0.1; }
        
        /* 6. Zone de Contenu Secondaire (Graphique et Prochaine Location) */
        .secondary-content-card h4 {
            font-weight: 700;
            color: var(--text-light);
            border-bottom: 1px solid var(--card-border-color);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        
        /* Style spécifique pour la carte de prochaine location */
        .next-loan-card {
            background: linear-gradient(145deg, var(--card-bg) 0%, #2e3b4d 100%);
            border: 1px solid var(--primary-color);
            overflow: hidden;
            position: relative;
            cursor: pointer;
        }
        
        .next-loan-card:hover {
            transform: scale(1.01);
            box-shadow: 0 10px 40px rgba(255, 107, 107, 0.5);
        }
        
        .loan-details h5 { color: var(--primary-color); font-weight: 600; font-size: 1.2rem; }
        .loan-details p { color: var(--text-muted); margin-bottom: 5px; font-size: 0.95rem; }
        .loan-details strong { color: var(--secondary-color); font-weight: 700; }
        .loan-details .car-name { font-size: 1.5rem; font-weight: 800; color: var(--text-light); margin-bottom: 15px; }
        
        /* Animations */
        .row.g-5 > div[class*="col"] { display: flex; }
        .card-animation { opacity: 0; transform: translateY(20px); animation: fadeInSlide 0.5s ease-out forwards; }
        @keyframes fadeInSlide { to { opacity: 1; transform: translateY(0); } }
        
    </style>
</head>
<body>

<header class="topbar">
    <a href="{{ route('client.dashboard') }}" class="logo">
        <i class="fas fa-car-side"></i> AutoGestion
    </a>
    
    <nav class="topbar-nav d-none d-lg-flex">
        <a href="{{ route('client.dashboard') }}" class="active"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}"><i class="fas fa-shopping-cart"></i> Panier</a>
        <a href="{{ route('client.loan') }}"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
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
    
    <div class="page-header">
        <h2>Bienvenue, {{ $userName ?? 'cher client' }} !</h2>
        <p>Gérez vos réservations, suivez vos dépenses et explorez notre catalogue.</p>
    </div>

    {{-- LIGNE 1 : Cartes de Statistiques --}}
    <div class="row g-5 mb-5"> 
        
        <div class="col-xl-3 col-md-6">
            <div class="stat-card card-animation">
                <i class="fas fa-shopping-basket stat-card-icon" style="color: var(--primary-color);"></i>
                <h5>VÉHICULES PANIER</h5>
                <h2>{{ $cartCount ?? 0 }}</h2>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stat-card card-animation" style="animation-delay: 0.2s;">
                <i class="fas fa-road stat-card-icon" style="color: #2ecc71;"></i>
                <h5>LOCATIONS ACTIVES</h5>
                <h2>{{ $loanCount ?? 0 }}</h2>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stat-card card-animation" style="animation-delay: 0.3s;">
                <i class="fas fa-receipt stat-card-icon" style="color: #f39c12;"></i>
                <h5>TRANSACTIONS TOTALES</h5>
                <h2>{{ $transactionCount ?? 0 }}</h2>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6">
            <div class="stat-card card-animation" style="animation-delay: 0.4s;">
                <i class="fas fa-money-bill-wave stat-card-icon" style="color: var(--secondary-color);"></i>
                <h5>DÉPENSE TOTALE</h5>
                <h2>{{ number_format($totalSpent ?? 0, 0, '.', ' ') }} USD</h2>
            </div>
        </div>
        
    </div>
    
    {{-- LIGNE 2 : Graphique et Prochaine Location --}}
    <div class="row g-5">
        
        {{-- Graphique d'Activité --}}
        <div class="col-lg-8">
            <div class="secondary-content-card card-animation" style="animation-delay: 0.5s;">
                <h4><i class="fas fa-chart-line me-2"></i> Historique des dépenses (USD)</h4>
                <div style="height: 350px;">
                    <canvas id="expenseChart"></canvas>
                </div>
            </div>
        </div>
        
        {{-- Carte Prochaine Location (AVEC CORRECTION DE L'ERREUR) --}}
        <div class="col-lg-4">
            <div class="secondary-content-card next-loan-card card-animation" style="animation-delay: 0.6s;">
                <h4 class="mb-4"><i class="fas fa-calendar-alt me-2"></i> Prochaine Location</h4>
                
                @isset($nextLoan) 
                    <div class="loan-details">
                        <p>Véhicule :</p>
                        <div class="car-name">{{ $nextLoan->vehicle_name ?? 'Véhicule Inconnu' }}</div>
                        <p><i class="fas fa-calendar-check me-2"></i> Début : <strong>{{ $nextLoan->start_date ?? 'N/A' }}</strong></p>
                        <p><i class="fas fa-calendar-times me-2"></i> Fin : <strong>{{ $nextLoan->end_date ?? 'N/A' }}</strong></p>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Lieu de prise : {{ $nextLoan->pickup_location ?? 'N/A' }}</p>
                        <p class="mt-3"><i class="fas fa-dollar-sign me-2"></i> Coût Total : 
                            <strong>{{ number_format($nextLoan->total_cost ?? 0, 2, '.', ' ') }} USD</strong>
                        </p>
                        
                        <a href="{{ route('client.loan.show', $nextLoan->id ?? '#') }}" class="btn btn-sm mt-3" style="background-color: var(--primary-color); color: white;">Voir les détails <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-plus" style="font-size: 3rem; color: var(--text-muted); opacity: 0.5;"></i>
                        <p class="mt-3 text-muted">Aucune location prévue pour le moment.</p>
                        <a href="{{ route('client.vehicles') }}" class="btn btn-sm mt-2" style="background-color: var(--secondary-color); color: white;">Réserver maintenant</a>
                    </div>
                @endisset
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
    let expenseChart = null;
    
    // Données simulées du graphique (À remplacer par vos données Blade/Laravel réelles)
    const chartLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
    const chartData = [500, 300, 850, 600, 1100, 750]; 

    // --- CHART.JS LOGIC ---
    function getChartColors() {
        // Lire les variables CSS en temps réel
        const isLight = body.classList.contains('light-mode');
        const rootStyles = getComputedStyle(document.documentElement);
        const primary = rootStyles.getPropertyValue('--primary-color').trim(); 
        const text = rootStyles.getPropertyValue('--text-light').trim();
        const mutedText = rootStyles.getPropertyValue('--text-muted').trim();
        
        return {
            lineColor: primary,
            fillColor: primary + '33', // 20% d'opacité
            textColor: isLight ? mutedText : text,
            gridColor: isLight ? 'rgba(0, 0, 0, 0.1)' : 'rgba(255, 255, 255, 0.1)',
        };
    }

    function createOrUpdateChart() {
        const colors = getChartColors();
        const ctx = document.getElementById('expenseChart').getContext('2d');

        if (expenseChart) {
            // Mise à jour si le graphique existe déjà (changement de thème)
            expenseChart.options.scales.y.grid.color = colors.gridColor;
            expenseChart.options.scales.y.ticks.color = colors.textColor;
            expenseChart.options.scales.x.ticks.color = colors.textColor;
            expenseChart.data.datasets[0].borderColor = colors.lineColor;
            expenseChart.data.datasets[0].backgroundColor = colors.fillColor;
            expenseChart.options.plugins.legend.labels.color = colors.textColor;
            expenseChart.update();
            return;
        }
        
        // Création initiale
        expenseChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Total Dépensé (USD)',
                    data: chartData,
                    borderColor: colors.lineColor,
                    backgroundColor: colors.fillColor,
                    tension: 0.4, 
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        align: 'end',
                        labels: { color: colors.textColor }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                if (label) { label += ': '; }
                                if (context.parsed.y !== null) {
                                    label += new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(context.parsed.y);
                                }
                                return label;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: colors.gridColor },
                        ticks: {
                            color: colors.textColor,
                            callback: function(value) { return value + ' $'; }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: colors.textColor }
                    }
                }
            }
        });
    }

    // --- MODE TOGGLE LOGIC ---

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
        // Assure que le graphique se met à jour avec les bonnes couleurs
        createOrUpdateChart();
    };

    // 1. Chargement initial 
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        applyTheme(true);
    } else {
        applyTheme(false); 
    }
    
    // 2. Événement du bouton
    toggleButton.addEventListener('click', () => {
        const isLight = body.classList.contains('light-mode');
        applyTheme(!isLight);
    });
});
</script>

</body>
</html>