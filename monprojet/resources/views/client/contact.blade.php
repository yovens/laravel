<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact Admin | AutoGestion</title>
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
            --card-bg: #2C3E50; /* Fond des cartes et Topbar */
            --form-control-bg: #37475a; /* Fond du champ plus clair que la carte */
            --form-control-border: #5a6b7d;
            --topbar-height: 65px;
            
            --header-text-color: var(--primary-color);
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
            --form-control-bg: #f8f9fa; 
            --form-control-border: #ced4da;
            
            --header-text-color: var(--primary-color);
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
        
        /* =================================================================== */
        /* === 2. Topbar (Navigation) ======================================== */
        /* =================================================================== */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
            display: flex;
            align-items: center;
            /* Changement pour aligner le toggle à droite */
            justify-content: space-between;
            padding: 0 40px;
            position: fixed; 
            top: 0;
            left: 0;
            right: 0;
            z-index: 1020;
            transition: background 0.3s, box-shadow 0.3s;
        }
        .logo {
            font-size: 22px; 
            font-weight: 700;
          color: var(--primary-color); 
            text-decoration: none;
            margin-right: 40px;
            transition: color 0.3s;
        }
        .logo i { color: var(--primary-color); margin-right: 5px; }

        .topbar-nav { 
            display: flex;
            align-items: center;
            margin-right: auto;
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
        }

        .topbar-nav a:hover, .topbar-nav a.active {
            color: var(--primary-color);
            border-bottom: 3px solid var(--primary-color);
        }

        /* Conteneur des actions (logout + toggle) */
        .topbar-actions { display: flex; align-items: center; gap: 15px; }

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
        
        /* =================================================================== */
        /* === 3. Styles Spécifiques Contact (Formulaire Centré Adaptatif) === */
        /* =================================================================== */
        .main-content {
            padding: 40px 40px 80px 40px;
        }

        .main-content h2 {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--header-text-color); /* Adaptatif */
            margin-bottom: 30px;
            border-bottom: 3px solid var(--card-bg); /* Adaptatif */
            padding-bottom: 15px;
            transition: color 0.3s, border-color 0.3s;
        }
        
        /* Conteneur du formulaire */
        .contact-card {
            background-color: var(--card-bg); /* Adaptatif */
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0px 10px 30px rgba(0,0,0,0.3);
            transition: background-color 0.3s;
        }
        
        /* Styles des champs de formulaire */
        .form-control {
            background-color: var(--form-control-bg); /* Adaptatif */
            border: 1px solid var(--form-control-border); /* Adaptatif */
            color: var(--text-light); /* Adaptatif */
            padding: 12px;
            border-radius: 8px;
            transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s, color 0.3s;
        }
        /* Placeholder styling for dark mode */
        body:not(.light-mode) .form-control::placeholder {
            color: #b0bec5; 
        }

        .form-control:focus {
            background-color: var(--form-control-bg);
            color: var(--text-light);
            border-color: var(--secondary-color);
            /* Utilisation des couleurs custom pour l'ombre focus */
            box-shadow: 0 0 0 0.25rem rgba(78, 205, 196, 0.25);
        }
        .light-mode .form-control:focus {
            /* Adapté pour le mode clair */
            box-shadow: 0 0 0 0.25rem rgba(0, 123, 255, 0.25);
        }
        
        /* Style des labels */
        label {
            font-weight: 600;
            color: var(--text-light); /* Adaptatif */
            margin-bottom: 5px;
            display: block;
            transition: color 0.3s;
        }

        /* Bouton Envoyer */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            font-weight: 700;
            padding: 14px;
            font-size: 1.1rem;
            border-radius: 10px;
            transition: transform 0.2s, background-color 0.2s;
        }
        .btn-primary:hover {
            background-color: #e65c5c; /* Lighter red */
            border-color: #e65c5c;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(255, 107, 107, 0.4);
        }
        .light-mode .btn-primary:hover {
            background-color: #0069d9; /* Darker blue */
            border-color: #0062cc;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.4);
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
        <a href="{{ route('client.loan') }}"><i class="fas fa-key"></i> Locations</a>
        <a href="{{ route('client.transactions') }}"><i class="fas fa-exchange-alt"></i> Transactions</a>
        <a href="{{ route('client.about') }}"><i class="fas fa-info-circle"></i> À Propos</a>
        <a href="#" class="active"><i class="fas fa-headset"></i> Contact</a> 
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

    <h2 class="mb-4"><i class="fas fa-paper-plane"></i> Contacter l’Administrateur</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="contact-card">
                <p class="text-muted text-center mb-4">
                    Utilisez ce formulaire pour toute question urgente, suggestion ou problème technique.
                </p>
                <form method="POST" action="{{ route('client.contact.send') }}">
                    @csrf
                    
                    <label for="subject">Objet</label>
                    <input type="text" id="subject" name="subject" class="form-control mb-3" required>
                    
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" class="form-control mb-4" required></textarea>
                    
                    <button type="submit" class="btn btn-primary w-100">Envoyer le Message</button>
                </form>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- Ajout du script de gestion de thème --}}
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
            // S'assurer que le thème par défaut est actif (dark-mode)
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