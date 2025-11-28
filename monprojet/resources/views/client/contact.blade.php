<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact Admin | AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <style>
        /* =================================================================== */
        /* === 1. Variables Globales (Dark Mode par défaut) ================== */
        /* =================================================================== */
        :root {
            --primary-color: #FF6B6B; /* Corail Vif (Action) */
            --secondary-color: #4ECDC4; /* Cyan Vif (Highlight, Focus) */
            --text-light: #EAEFF4; 
            --text-muted: #94a3b8; 
            --bg-page: #0D1117; /* Fond : Noir Galaxie */
            --card-bg: #161B22; /* Fond des cartes et Topbar (Darker) */
            --form-control-bg: #21262D; /* Fond du champ plus clair que la carte */
            --form-control-border: #30363D;
            --topbar-height: 70px;
            
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
            --bg-page: #f4f6f9; /* Fond : Très clair */
            --card-bg: #ffffff; /* Fond Topbar/Card Clair */
            --form-control-bg: #f8f9fa; 
            --form-control-border: #ced4da;
            
            --header-text-color: var(--primary-color);
        }

        /* Styles de base */
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: var(--bg-page);
            min-height: 100vh;
            color: var(--text-light);
            padding-top: var(--topbar-height); 
            transition: background-color 0.4s, color 0.4s;
        }
        
        /* =================================================================== */
        /* === 2. Topbar (Navigation) - Harmonisé ============================ */
        /* =================================================================== */
        .topbar {
            height: var(--topbar-height);
            background: var(--card-bg);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); 
            border-bottom: 1px solid var(--form-control-border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 40px;
            position: fixed; top: 0; left: 0; right: 0; z-index: 1020;
            transition: all 0.4s;
        }
        .logo { font-size: 24px; font-weight: 800; color: var(--primary-color); text-decoration: none; margin-right: 30px; }
        .logo i { color: var(--primary-color); margin-right: 5px; }
        .topbar-nav { display: flex; align-items: center; flex-grow: 1; }
        .topbar-nav a {
            color: var(--text-muted); font-weight: 500; padding: 8px 15px; text-decoration: none;
            transition: all 0.3s; border-bottom: 3px solid transparent; margin: 0 5px;
            font-size: 0.95rem; display: inline-flex; align-items: center; gap: 6px;
        }
        .topbar-nav a:hover, .topbar-nav a.active {
            color: var(--primary-color); border-bottom: 3px solid var(--primary-color); background-color: rgba(var(--primary-color), 0.1);
        }
        .topbar-actions { display: flex; align-items: center; gap: 15px; }

        .btn-logout {
            border: 2px solid var(--primary-color); color: var(--primary-color); background-color: transparent;
            padding: 8px 18px; font-weight: 600; text-transform: uppercase; border-radius: 6px; transition: all 0.2s;
        }
        .btn-logout:hover {
            background-color: var(--primary-color); color: var(--bg-page); box-shadow: 0 4px 15px rgba(255, 107, 107, 0.6); transform: scale(1.02);
        }
        .btn-theme-toggle { background: none; border: none; color: var(--text-muted); font-size: 1.5rem; cursor: pointer; transition: color 0.3s, transform 0.2s; }
        .btn-theme-toggle:hover { color: var(--primary-color); transform: scale(1.1); }
        
        /* =================================================================== */
        /* === 3. Styles Spécifiques Contact (Ultra-Focus) =================== */
        /* =================================================================== */
        .main-content {
            padding: 40px;
            max-width: 1200px;
            margin: auto;
        }

        .main-content h2 {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--header-text-color); 
            margin-bottom: 40px;
            text-align: center;
            text-shadow: 0 0 10px rgba(var(--primary-color), 0.3);
            padding-bottom: 15px;
            transition: all 0.3s;
        }
        
        /* Conteneur du formulaire */
        .contact-card {
            background-color: var(--card-bg); 
            border-radius: 20px; /* Plus arrondis */
            padding: 50px;
            box-shadow: 0px 15px 50px rgba(0,0,0,0.5); /* Ombre plus profonde */
            border: 1px solid var(--form-control-border);
            transition: background-color 0.4s, border-color 0.4s;
        }
        
        /* Styles des champs de formulaire */
        .form-control {
            background-color: var(--form-control-bg); 
            border: 2px solid var(--form-control-border); /* Bordure plus épaisse */
            color: var(--text-light); 
            padding: 15px; /* Plus de padding */
            border-radius: 12px;
            font-size: 1.05rem;
            box-shadow: none;
            transition: border-color 0.3s, box-shadow 0.3s, background-color 0.3s;
        }
        
        .form-control::placeholder {
            color: var(--text-muted); 
            opacity: 0.6;
        }

        .form-control:focus {
            background-color: var(--form-control-bg);
            color: var(--text-light);
            border-color: var(--secondary-color); /* Cyan Focus */
            box-shadow: 0 0 0 4px rgba(78, 205, 196, 0.4); /* Ombre Cyan intense */
        }
        /* Ajustement du focus en mode clair */
        .light-mode .form-control:focus {
            border-color: var(--primary-color); /* Bleu Focus */
            box-shadow: 0 0 0 4px rgba(0, 123, 255, 0.4);
            color: var(--text-light);
        }
        
        /* Style des labels */
        label {
            font-weight: 700;
            color: var(--text-light); 
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.1rem;
        }

        /* Bouton Envoyer (Ultra-Action) */
        .btn-submit {
            /* Dégradé pour effet 3D en Dark Mode */
            background: linear-gradient(135deg, var(--primary-color) 0%, #FF8C8C 100%); 
            border-color: var(--primary-color);
            color: white;
            font-weight: 800;
            padding: 16px;
            font-size: 1.2rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 8px 20px rgba(255, 107, 107, 0.4);
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #FF8C8C 0%, var(--primary-color) 100%);
            border-color: #FF8C8C;
            transform: translateY(-4px) scale(1.01); /* Effet "pop" */
            box-shadow: 0 12px 25px rgba(255, 107, 107, 0.6);
        }

        /* Bouton Envoyer Light Mode */
        .light-mode .btn-submit {
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 8px 20px rgba(0, 123, 255, 0.3);
        }
        .light-mode .btn-submit:hover {
            background-color: #0056b3; 
            border-color: #0056b3;
            box-shadow: 0 12px 25px rgba(0, 123, 255, 0.5);
        }
    </style>
</head>
<body class="dark-mode">

<header class="topbar">
    <a href="{{ route('client.dashboard') }}" class="logo">
        <i class="fas fa-car-side"></i> AutoGestion
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

    <h2><i class="fas fa-paper-plane me-2"></i> Contacter l’Administrateur</h2>

    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="contact-card">
                <p class="text-muted text-center mb-5 lead">
                    Pour toute question urgente, suggestion ou problème technique, nous sommes là pour vous aider.
                </p>
                <form method="POST" action="{{ route('client.contact.send') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="subject"><i class="fas fa-tag"></i> Objet</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Ex: Problème de connexion, Suggestion de fonctionnalité..." required>
                    </div>
                    
                    <div class="mb-5">
                        <label for="message"><i class="fas fa-comment-dots"></i> Message</label>
                        <textarea id="message" name="message" rows="6" class="form-control" placeholder="Décrivez votre requête en détail..." required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-submit w-100">
                        <i class="fas fa-envelope me-2"></i> Envoyer le Message
                    </button>
                </form>
            </div>
        </div>
    </div>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
{{-- Script de gestion de thème --}}
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