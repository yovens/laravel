<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Panier | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">




    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            /* Couleurs Dark Mode */
            --primary-color: #FF6B6B; 
            --secondary-color: #4ECDC4; 
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #1F2937; 
            --card-bg: #2C3E50; 
            --table-header-bg: #1A232F;
            --table-border: #3d526a;
            --topbar-height: 65px;
            
            /* Couleurs Bootstrap Adaptées */
            --bs-table-hover-bg: #3d526a; 
            --bs-table-hover-color: var(--text-light);
            --bs-btn-danger-color: var(--text-light);
        }

        /* Variables Light Mode */
        .light-mode {
            --primary-color: #007bff;
            --secondary-color: #28a745;
            --text-light: #343a40;
            --text-muted: #6c757d; 
            --bg-page: #f8f9fa;
            --card-bg: #ffffff;
            --table-header-bg: #e9ecef;
            --table-border: #dee2e6;
            --bs-table-hover-bg: #e9ecef; 
            --bs-table-hover-color: var(--text-light);
            --bs-btn-danger-color: #fff;
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
            transition: background-color 0.3s, color 0.3s;
        }
        
        /* CORRECTION TOP BAR : Utiliser Flexbox pour un alignement parfait */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            display: flex; /* Active Flexbox */
            align-items: center; /* Alignement vertical centré */
            justify-content: space-between; /* Espace les éléments aux extrémités */
            padding: 0 40px;
            position: fixed; 
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
        }
        
        .logo { 
            font-size: 22px; 
            font-weight: 700; 
            color: var(--primary-color); 
            text-decoration: none; 
            margin-right: 30px; /* Ajout d'une marge à droite du logo */
            white-space: nowrap; /* Empêche le logo de se casser sur plusieurs lignes */
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
            gap: 15px; /* Ajout d'un espacement entre le bouton de thème et le bouton de déconnexion */
        }

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
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            /* margin-right: 15px; Éliminé car géré par le gap dans .topbar-actions */
            transition: color 0.3s, transform 0.2s;
        }
        .btn-theme-toggle:hover {
            color: var(--primary-color);
            transform: scale(1.1);
        }

        /* Styles de contenu (Panier) (Non modifiés) */
        .main-content { padding: 40px 40px 80px 40px; }
        .main-content h2 { color: var(--primary-color); border-bottom-color: var(--table-border); padding-bottom: 15px; }
        .table { background-color: var(--card-bg); color: var(--text-light); }
        .table > :not(caption) > * > * { border-color: var(--table-border); }
        .table-dark { --bs-table-bg: var(--table-header-bg); --bs-table-color: var(--text-light); }
       
        .btn-primary.checkout { background-color: var(--secondary-color) !important; border-color: var(--secondary-color) !important; color: var(--bg-page) !important; }

    </style>
</head>
<body>

<header class="topbar">
    
    <a href="{{ route('client.dashboard') }}" class="logo">
      AutoGestion
    </a>
    
    <nav class="topbar-nav">
        <a href="{{ route('client.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
        <a href="{{ route('client.vehicles') }}"><i class="fas fa-car"></i> Véhicules</a>
        <a href="{{ route('client.cart') }}" class="active"><i class="fas fa-shopping-cart"></i> Panier</a>
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
    <br>
    <br>
    {{-- Le contenu de la page Panier est le même --}}
    <h2 class="mb-4">🛒 Mon Panier</h2>

    @if($cartItems->isEmpty())
        <div class="alert alert-info text-center shadow">
            Votre panier est vide. Trouvez votre prochaine voiture dans la section Véhicules !
        </div>
    @else

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover shadow-lg">
                <thead class="table-dark">
                    <tr>
                        <th>Image</th>
                        <th>Véhicule</th>
                        <th>Année</th>
                        <th>Prix</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody >

                @foreach($cartItems as $item)
                    <tr>
                        <td style="width:180px;">
                            <img src="/storage/{{ $item->vehicle->image }}" class="img-fluid rounded" alt="Image de {{ $item->vehicle->brand }} {{ $item->vehicle->model }}">
                        </td>
                        <td class="align-middle fw-bold" >{{ $item->vehicle->brand }} - {{ $item->vehicle->model }}</td>
                        <td class="align-middle">{{ $item->vehicle->year }}</td>
                        <td class="align-middle fw-bold">{{ number_format($item->vehicle->price) }} USD</td>
                        <td class="align-middle">
                            <form method="POST" action="{{ route('client.cart.delete', $item->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
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
    
    <div class="text-end mt-4">
        <a href="#" class="btn btn-primary btn-lg checkout">
            <i class="fas fa-credit-card"></i> Passer à la caisse
        </a>
    </div>

    @endif

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.getElementById('theme-toggle');
        const body = document.body;
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


