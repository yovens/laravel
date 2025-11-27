<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification - AutoGestion</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {
            margin: 0;
            height: 100vh;
            overflow: hidden;
            font-family: "Poppins", sans-serif;
            background: linear-gradient(135deg, #0f172a, #1e293b, #3b82f6);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container-box {
            width: 900px;
            height: 550px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            border-radius: 25px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.4);
            position: relative;
            overflow: hidden;
            display: flex;
        }

        /* PANNEAU GAUCHE */
        .left-panel {
            width: 50%;
            padding: 40px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            animation: fadeIn 1.6s ease;
        }

        .left-panel h1 {
            font-size: 40px;
            font-weight: 700;
        }

        .left-panel p {
            margin-top: 15px;
            font-size: 16px;
            opacity: 0.9;
        }

        .left-panel img {
            width: 120px;
            margin-bottom: 20px;
        }

        /* FORM CONTAINER */
        .form-container {
            width: 50%;
            background: rgba(255,255,255,0.08);
            padding: 45px;
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            transition: 0.6s ease;
        }

        .form-container.slide {
            transform: translateX(-100%);
        }

        h3 {
            color: #fff;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .form-control {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
            padding: 12px;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .btn-main {
            background: #3b82f6;
            border: none;
            padding: 10px;
            border-radius: 12px;
            width: 100%;
            font-weight: 600;
            color: #fff;
        }

        .switch-link {
            color: #93c5fd;
            cursor: pointer;
        }

        @keyframes fadeIn {
            from {opacity:0; transform: translateY(20px);}
            to {opacity:1; transform: translateY(0);}
        }
    </style>
</head>

<body>

<div class="container-box">

    <!-- PANEL GAUCHE -->
    <div class="left-panel">
        <img src="{{ asset('images/logo.png') }}" alt="logo">
        <h1>AutoGestion</h1>
        <p>
            Plateforme de location & vente de véhicules premium.  
            Fiabilité, performance, luxe et satisfaction client sont notre priorité.
        </p>
    </div>

    <!-- LOGIN FORM -->
    <div class="form-container" id="login-box">

        <h3>Connexion</h3>

        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <input type="email" name="email" class="form-control"
                   placeholder="Email" required>

            <input type="password" name="password" class="form-control"
                   placeholder="Mot de passe" required>

            <button class="btn-main">Se connecter</button>

            <p class="mt-3 text-center">
                Pas de compte ? 
                <span class="switch-link" onclick="showRegister()">Créer un compte</span>
            </p>
        </form>
    </div>

    <!-- REGISTER FORM -->
    <div class="form-container slide" id="register-box">

        <h3>Créer un compte</h3>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <input type="text" name="nom" class="form-control"
                   placeholder="Nom complet" required>

            <input type="email" name="email" class="form-control"
                   placeholder="Email" required>

            <input type="password" name="password" class="form-control"
                   placeholder="Mot de passe" required>

            <button class="btn-main">S'inscrire</button>

            <p class="mt-3 text-center">
                Déjà un compte ?  
                <span class="switch-link" onclick="showLogin()">Se connecter</span>
            </p>
        </form>
    </div>

</div>

<script>
    function showRegister() {
        document.getElementById("login-box").classList.add("slide");
        document.getElementById("register-box").classList.remove("slide");
    }

    function showLogin() {
        document.getElementById("login-box").classList.remove("slide");
        document.getElementById("register-box").classList.add("slide");
    }
</script>

</body>
</html>
