<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification - AutoGestion Plus Ultra</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    
    <style>
        /* === 1. VARIABLES & FOND ANIMÉ (PLUS ULTRA) === */
        :root {
            --primary-color: #0d9488; /* Vert Teck / Turquoise */
            --secondary-color: #3b82f6; /* Bleu Vif */
            --bg-dark: #0f172a; /* Bleu Nuit Profond */
            --bg-card: #1e293b; /* Bleu foncé de la carte */
            --text-light: #f1f5f9;
            --input-bg: rgba(255, 255, 255, 0.08);
            --shadow-color: rgba(13, 148, 136, 0.4); 
            
            /* NOUVELLES COULEURS POUR L'EFFET LUMINEUX */
            --glow-1: #06b6d4; /* Cyan */
            --glow-2: #8b5cf6; /* Violet */
        }

        body {
            height: 100vh;
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-dark);
            color: var(--text-light);
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden; 
            padding: 20px;
            position: relative; 
        }

        /* 1A. EFFET AUBE NUMÉRIQUE (Aurore Boréale) */
        .digital-aurora {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            filter: blur(80px); 
            opacity: 0.6;
            pointer-events: none;
        }

        .aurora-blob {
            position: absolute;
            border-radius: 50%;
            mix-blend-mode: screen; 
            animation-duration: 20s;
            animation-iteration-count: infinite;
            animation-timing-function: ease-in-out;
        }

        .blob-1 {
            width: 400px;
            height: 400px;
            background-color: var(--glow-1);
            top: -100px;
            left: -100px;
            animation-name: moveBlob1;
            opacity: 0.7;
        }

        .blob-2 {
            width: 500px;
            height: 500px;
            background-color: var(--glow-2);
            bottom: -200px;
            right: -100px;
            animation-name: moveBlob2;
            opacity: 0.6;
        }

        @keyframes moveBlob1 {
            0%, 100% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50vw, 30vh) scale(1.1); }
        }

        @keyframes moveBlob2 {
            0%, 100% { transform: translate(0, 0) scale(1.1); }
            50% { transform: translate(-30vw, -40vh) scale(0.9); }
        }


        /* 1B. FOND DE PARTICULES (AJOUTÉ via ::before) */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-image: 
                radial-gradient(var(--text-light) 1px, transparent 1px),
                radial-gradient(var(--text-light) 1px, transparent 1px);
            background-size: 50px 50px;
            background-position: 0 0, 25px 25px;
            opacity: 0.1; 
            animation: moveStarfield 300s linear infinite;
        }

        @keyframes moveStarfield {
            from { background-position: 0 0, 25px 25px; }
            to { background-position: 500px 500px, 525px 525px; }
        }


        /* === 2. STRUCTURE GLOBALE (NEUMORPHISME INVERSÉ AVEC GLOW) === */
        .container-box {
            z-index: 10; 
            width: 950px; 
            max-width: 95%;
            height: 580px; 
            display: flex;
            border-radius: 20px;
            overflow: hidden;
            background: var(--bg-card);
            
            /* CONTOUR GLOW ANIMÉ */
            position: relative; 
            box-shadow: 0 0 0 1px rgba(255, 255, 255, 0.1),
                        0 10px 30px rgba(0, 0, 0, 0.6);
        }

        /* Pseudo-élément pour l'animation de bordure */
        .container-box::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--glow-1), var(--primary-color), var(--secondary-color), var(--glow-2));
            background-size: 400% 400%;
            z-index: -1;
            border-radius: 22px; 
            opacity: 0.5; 
            animation: borderGlow 15s ease infinite;
        }

        @keyframes borderGlow {
            0% { background-position: 0% 50%; opacity: 0.5; }
            50% { background-position: 100% 50%; opacity: 0.8; }
            100% { background-position: 0% 50%; opacity: 0.5; }
        }

        /* 4A. Structure des formulaires (Desktop/Grand écran) */
        .auth-container {
            width: 50%; 
            position: relative;
            overflow: hidden; /* Cache le formulaire non actif en mode desktop */
        }
        .forms {
            width: 200%; /* Contient les deux formulaires (100% + 100%) */
            height: 100%;
            display: flex;
            transition: transform 0.6s ease-in-out;
        }
        .form-container {
            width: 50%; /* Chaque formulaire prend 50% de .forms (soit 100% de .auth-container) */
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        
        /* 💡 CORRECTION CLÉ 💡: Assurer l'affichage en Desktop pour la translation */
        @media(min-width: 993px) { 
            .form-container {
                display: flex !important; /* Force l'affichage pour le glissement (translateX) */
            }
        }
        /* ------------------------------------------------------------------------ */


        /* === 3. PANNEAU LATÉRAL (VISUEL) === */
        .left-panel {
            width: 50%;
            background: linear-gradient(180deg, var(--bg-dark), var(--bg-card) 60%);
            padding: 40px;
            color: var(--text-light);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 2;
        }
        
        .left-panel::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 10px;
            height: 100%;
            box-shadow: inset -5px 0 10px rgba(0, 0, 0, 0.4);
            pointer-events: none;
        }

        .left-panel h1 {
            font-size: 38px;
            font-weight: 900; 
            margin-top: 15px;
            background-image: linear-gradient(45deg, var(--primary-color), #ffffff, var(--secondary-color));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            color: transparent;
            letter-spacing: 2px;
        }

        .icon-car {
            font-size: 5rem;
            color: var(--secondary-color);
            margin-bottom: 10px;
            animation: pulse 2s infinite ease-in-out, 
                       iconShine 3s infinite linear; 
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes iconShine {
            0% { text-shadow: 0 0 5px var(--secondary-color); }
            50% { text-shadow: 0 0 15px var(--secondary-color), 0 0 30px var(--glow-1); }
            100% { text-shadow: 0 0 5px var(--secondary-color); }
        }

        /* === 4. FORMULAIRES & INPUTS (Identique à votre version) === */
        /* ... (styles inputs, buttons, etc. inchangés) ... */
        .input-group {
            margin-bottom: 20px;
            width: 100%;
            position: relative;
        }
        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.5);
            font-size: 1rem;
            transition: color 0.3s;
        }
        .form-control {
            width: 100%;
            padding: 12px 12px 12px 45px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            background: var(--input-bg);
            color: var(--text-light);
            transition: border-color 0.3s, background 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(13, 148, 136, 0.25);
            color: var(--text-light);
        }
        
        .input-group:focus-within i {
            color: var(--primary-color);
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .btn-main {
            background: var(--primary-color);
            color: var(--bg-dark); 
            width: 100%;
            padding: 14px;
            font-weight: 700;
            border-radius: 10px;
            border: none;
            margin-top: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-main:hover {
            background: #10b981; 
            transform: translateY(-3px) scale(1.01); 
            box-shadow: 0 10px 20px var(--shadow-color); 
        }
        
        .alert {
            border-radius: 10px;
            font-size: 0.9rem;
            border: none;
        }
        .alert-danger {
            background-color: rgba(252, 165, 165, 0.15);
            color: var(--primary-color);
            border-left: 3px solid var(--primary-color);
        }

        .switch-link {
            color: var(--primary-color);
            cursor: pointer;
            text-decoration: underline;
            font-weight: 600;
            transition: color 0.3s;
        }
        .switch-link:hover {
            color: var(--glow-1);
        }

        /* Masquer le lien de switch MOBILE sur desktop */
        .switch-link-mobile {
            display: none; 
        }

        /* === 5. RESPONSIVE (Mobile) === */
        @media(max-width: 992px) {
            .container-box {
                width: 400px; 
                height: auto;
                flex-direction: column;
                margin-top: 20px;
            }
            .left-panel {
                width: 100%;
                height: 200px;
                border-radius: 20px 20px 0 0;
            }
            /* Masquer l'ombre du panneau de gauche en mobile */
            .left-panel::after {
                display: none;
            }

            .auth-container {
                width: 100%; /* Prend toute la largeur */
                height: auto;
                overflow: visible; /* Ne plus cacher pour que le contenu s'étende */
            }
            .forms {
                width: 100%; /* Plus de 200% */
                height: auto;
                flex-direction: column;
                transition: none; /* Désactive la translation */
                transform: translateX(0) !important; /* Assure que la translation est à zéro */
            }
            .form-container {
                width: 100%;
                padding: 30px 25px;
                display: none; /* Masqué par défaut sur mobile/tablette */
            }
            .form-container.active-form {
                display: flex; /* Affiche uniquement l'actif géré par JS */
            }
            .left-panel p {
                display: none; /* Cache le texte long sur petit écran */
            }
            .icon-car {
                font-size: 3rem;
            }
            .form-container:last-child {
                border-top: 1px solid rgba(255, 255, 255, 0.1);
            }
            /* Afficher le lien de switch MOBILE */
            .switch-link-mobile {
                display: block;
                margin-top: 20px;
                text-decoration: none;
                font-weight: 600;
                color: var(--secondary-color);
            }
            /* Masquer le lien de switch DESKTOP en mobile */
            .switch-link {
                display: none;
            }
        }

    </style>
</head>
<body class="dark-mode">

{{-- Conteneur pour l'effet d'Aurore Numérique --}}
<div class="digital-aurora">
    <div class="aurora-blob blob-1"></div>
    <div class="aurora-blob blob-2"></div>
</div>

<div class="container-box">
    
    <div class="left-panel">
       
        <h1>AutoGestion</h1>
        <p>Plateforme de location & vente de véhicules premium.<br>Fiabilité, performance et luxe au service de nos clients.</p>
    </div>

    <div class="auth-container">
        <div class="forms" id="forms">
            <div class="form-container active-form" id="login-form">
                <h3><i class="fas fa-sign-in-alt me-2"></i> Connexion Client</h3>
                @if($errors->any())
                    <div class="alert alert-danger w-100 text-center">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('login.submit') }}" class="w-100">
                    @csrf
                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Adresse Email" required>
                    </div>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control" placeholder="Mot de passe" required>
                    </div>
                    <button class="btn-main">Se connecter</button>
                </form>
                {{-- Lien DESKTOP --}}
                <p class="mt-4 text-center">
                    Pas de compte ? 
                    <span class="switch-link" onclick="toggleForms(false)">Créer un compte</span>
                </p>
                {{-- Lien MOBILE --}}
                <a href="#" class="switch-link-mobile" onclick="toggleForms(false); return false;">Créer un compte</a>
            </div>

            <div class="form-container" id="register-form">
                <h3><i class="fas fa-user-plus me-2"></i> Créer un compte</h3>
                <form method="POST" action="{{ route('register.submit') }}" class="w-100">
                    @csrf
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nom" class="form-control" placeholder="Nom complet" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-envelope"></i>
                        <input type="email" name="email" class="form-control" placeholder="Adresse Email" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" class="form-control"
                               placeholder="Mot de passe (Min 8 caractères)" required>
                    </div>

                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password_confirmation"
                               class="form-control" placeholder="Confirmer le mot de passe" required>
                    </div>

                    <button class="btn-main">S'inscrire</button>
                </form>

                {{-- Lien DESKTOP --}}
                <p class="mt-4 text-center">
                    Déjà un compte ? 
                    <span class="switch-link" onclick="toggleForms(true)">Se connecter</span>
                </p>
                {{-- Lien MOBILE --}}
                <a href="#" class="switch-link-mobile" onclick="toggleForms(true); return false;">Se connecter</a>
            </div>
        </div>
    </div>
</div>

<script>
    const formsContainer = document.getElementById('forms');
    const loginForm = document.getElementById('login-form');
    const registerForm = document.getElementById('register-form');
    
    /**
     * Gère la bascule entre les formulaires. 
     * Applique la translation (Desktop) ou met à jour la classe 'active-form' (Mobile).
     * @param {boolean} isLogin - True pour afficher la connexion, False pour l'inscription.
     */
    function toggleForms(isLogin) {
        // 1. Mettre à jour les classes actives (nécessaire pour CSS mobile et l'état de redimensionnement)
        if (isLogin) {
            loginForm.classList.add('active-form');
            registerForm.classList.remove('active-form');
        } else {
            loginForm.classList.remove('active-form');
            registerForm.classList.add('active-form');
        }

        // 2. Appliquer la translation si nous sommes en mode Desktop
        if (window.innerWidth > 992) {
            formsContainer.style.transform = isLogin ? 'translateX(0)' : 'translateX(-50%)';
        }
        // Note: Sur mobile, la translation est réinitialisée par handleScreenSize
    }

    
    /**
     * Gère l'état de la vue lors du redimensionnement de l'écran.
     */
    function handleScreenSize() {
        const isLoginActive = loginForm.classList.contains('active-form');
        
        if (window.innerWidth > 992) {
            // MODE DESKTOP : Gérer la translation
            formsContainer.style.transform = isLoginActive ? 'translateX(0)' : 'translateX(-50%)';

        } else {
            // MODE MOBILE : Supprimer la translation
            formsContainer.style.transform = 'translateX(0)'; 
            // L'affichage est géré par la classe .active-form et le CSS media query.
        }
    }

    // Exécuter au chargement initial
    document.addEventListener('DOMContentLoaded', () => {
        // Déterminer quel formulaire est actif par défaut (utile pour les liens externes)
        const urlParams = new URLSearchParams(window.location.search);
        const isRegister = urlParams.get('form') === 'register';

        // Initialiser l'état via toggleForms pour définir la bonne classe et le bon transform
        toggleForms(!isRegister); 
        
        // Appliquer le bon état au chargement 
        handleScreenSize(); 
    });
    
    // Exécuter lors du redimensionnement de la fenêtre
    window.addEventListener('resize', handleScreenSize);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>