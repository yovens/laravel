<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier | AutoGestion</title>
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
            /* Couleurs Dark Mode */
            --primary-color: #FF6B6B; /* Rouge Corail Vif */
            --secondary-color: #4ECDC4; /* Cyan/Vert d'eau pour l'action principale */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #161B22; /* Noir très foncé, comme dans l'exemple précédent */
            --card-bg: #1F2A37; /* Fond des cartes/panneaux */
            --table-header-bg: #1A232F;
            --table-border: #3d526a;
            --topbar-height: 70px;
            
            /* Couleurs Bootstrap Adaptées */
            --bs-table-hover-bg: #2C3E50; 
            --bs-table-hover-color: var(--text-light);
            --bs-btn-danger-color: var(--text-light);
            --price-color: var(--primary-color);
            --total-bg: #2C3E50;
            --total-border: var(--primary-color);
        }

        /* Variables Light Mode */
        .light-mode {
            --primary-color: #007bff;
            --secondary-color: #28a745;
            --text-light: #343a40;
            --text-muted: #6c757d; 
            --bg-page: #f4f6f9;
            --card-bg: #ffffff;
            --table-header-bg: #e9ecef;
            --table-border: #dee2e6;
            --bs-table-hover-bg: #e9ecef; 
            --bs-table-hover-color: var(--text-light);
            --bs-btn-danger-color: #fff;
            --price-color: var(--primary-color);
            --total-bg: #ffffff;
            --total-border: var(--primary-color);
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
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            border-bottom: 1px solid var(--table-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 40px;
            position: fixed; 
            top: 0; left: 0; right: 0;
            z-index: 1020;
            transition: background 0.4s, box-shadow 0.4s, border-color 0.4s;
        }
        
        .logo { 
            font-size: 24px; 
            font-weight: 800; 
            color: var(--primary-color); 
            text-decoration: none; 
            text-shadow: 0 0 5px rgba(255, 107, 107, 0.3);
            margin-right: 30px;
            white-space: nowrap;
        }
        .light-mode .logo { text-shadow: none; }
        .logo i { color: var(--primary-color); margin-right: 5px; }

        .topbar-nav { 
            display: flex; 
            align-items: center; 
            flex-grow: 1; 
        }
        .topbar-nav a {
            color: var(--text-muted);
            font-weight: 500;
            padding: 8px 15px;
            text-decoration: none;
            transition: all 0.3s;
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
            background-color: var(--table-header-bg); /* Donne un petit lift */
        }
        
        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

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
            color: var(--bg-page);
            box-shadow: 0 4px 15px rgba(255, 107, 107, 0.6);
            transform: scale(1.02);
        }
        
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

        /* =================================================================== */
        /* === 3. Styles Spécifiques Panier (Améliorés) ====================== */
        /* =================================================================== */
        .main-content { 
            padding: 40px 0 80px 0; /* On retire les padding latéraux pour le container */
        }
        
        .cart-container {
            max-width: 1200px; /* Largeur maximale pour le contenu */
            margin: 0 auto;
            padding: 0 20px;
        }

        .main-content h2 { 
            font-weight: 800;
            color: var(--primary-color); 
            border-bottom: 2px solid var(--table-border);
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        
        /* Style du tableau */
        .table { 
            background-color: var(--card-bg); 
            color: var(--text-light); 
            border-radius: 10px;
            overflow: hidden; /* Pour que le border-radius s'applique */
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-bordered { border: 1px solid var(--table-border) !important; }
        .table > :not(caption) > * > * { border-color: var(--table-border); padding: 15px; }

        /* En-tête de la table */
        .table-dark { 
            --bs-table-bg: var(--table-header-bg); 
            --bs-table-color: var(--text-light); 
            font-size: 1rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        /* Lignes de la table */
        tbody tr:hover {
            background-color: var(--bs-table-hover-bg) !important;
        }

        /* Prix */
        .price-col {
            color: var(--price-color);
            font-size: 1.1rem;
            font-weight: 700;
        }

        /* Image du véhicule dans le tableau */
        .table img {
            width: 120px; 
            height: auto; 
            object-fit: cover;
            border-radius: 6px;
            border: 2px solid var(--table-header-bg);
            transition: border-color 0.3s;
        }
        .light-mode .table img {
             border: 2px solid var(--table-border);
        }
        
        /* Bouton Supprimer */
        .btn-delete {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            color: white !important;
            transition: all 0.2s;
        }
        .btn-delete:hover {
            background-color: #d14747 !important;
            transform: translateY(-1px);
        }
        
        /* Récapitulatif et Bouton Checkout */
        .summary-card {
            background-color: var(--total-bg);
            border: 2px solid var(--total-border);
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            margin-top: 30px;
        }
        .summary-card h4 {
            font-weight: 700;
            border-bottom: 1px dashed var(--table-border);
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: var(--secondary-color);
        }
        .summary-card .total-price {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-color);
        }
        
        .btn-checkout { 
            background-color: var(--secondary-color) !important; 
            border-color: var(--secondary-color) !important; 
            color: var(--bg-page) !important; 
            font-size: 1.2rem;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-checkout:hover {
            background-color: #2ecc71 !important;
            border-color: #2ecc71 !important;
            box-shadow: 0 5px 15px rgba(78, 205, 196, 0.5);
            transform: translateY(-2px);
        }

    </style>
</head>
<body class="dark-mode">

<header class="topbar">
    
    <a href="{{ route('client.dashboard') }}" class="logo">
        <i class="fas fa-car-side"></i> AutoGestion
    </a>
    
    <nav class="topbar-nav d-none d-lg-flex">
        <a href="{{ route('client.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}" class="active"><i class="fas fa-shopping-cart"></i> Panier</a>
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
    <div class="cart-container">

        <h2 class="mb-4">🛒 Mon Panier</h2>

        @if($cartItems->isEmpty())
            <div class="alert alert-info text-center shadow">
                <i class="fas fa-exclamation-circle me-2"></i> Votre panier est vide. Trouvez votre prochaine voiture dans la section Véhicules !
            </div>
        @else

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover shadow-lg">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">Image</th>
                                <th>Véhicule</th>
                                <th>Année</th>
                                <th class="text-end">Prix</th>
                                <th class="text-center" style="width: 150px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        @php $totalPrice = 0; @endphp
                        @foreach($cartItems as $item)
                            @php $totalPrice += $item->vehicle->price; @endphp
                            <tr>
                                <td class="text-center">
                                    <img src="/storage/{{ $item->vehicle->image }}" class="img-fluid" alt="Image de {{ $item->vehicle->brand }} {{ $item->vehicle->model }}">
                                </td>
                                <td class="align-middle fw-bold">{{ $item->vehicle->brand }} - {{ $item->vehicle->model }}</td>
                                <td class="align-middle text-muted">{{ $item->vehicle->year }}</td>
                                <td class="align-middle text-end price-col">{{ number_format($item->vehicle->price) }} USD</td>
                                <td class="align-middle text-center">
                                    <form method="POST" action="{{ route('client.cart.delete', $item->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete w-100">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        {{-- Récapitulatif du Panier --}}
        <div class="row justify-content-end">
            <div class="col-lg-5 col-md-7">
                <div class="summary-card">
                    <h4><i class="fas fa-file-invoice-dollar me-2"></i> Récapitulatif de la commande</h4>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Sous-total ({{ $cartItems->count() }} articles) :</span>
                        <span class="fw-bold">{{ number_format($totalPrice) }} USD</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4">
                        <span>Taxe estimée (0%) :</span>
                        <span class="fw-bold">0 USD</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fs-5 fw-bold">TOTAL À PAYER :</span>
                        <span class="total-price">{{ number_format($totalPrice) }} USD</span>
                    </div>

                    <a href="#" class="btn btn-checkout w-100">
                        <i class="fas fa-credit-card me-2"></i> Passer à la Caisse
                    </a>
                </div>
            </div>
        </div>

        @endif
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