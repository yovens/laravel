<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon Profil - AutoGestion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* === 1. VARIABLES (Dark Mode par défaut) === */
        :root {
            --sidebar-width: 260px;
            --bg-color: #1a202c;
            --sidebar-bg: #2d3748;
            --accent-color: #38bdf8;
            --card-bg: rgba(45, 55, 72, 0.8);
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
            background: linear-gradient(135deg, #0f172a, #1e293b, #0d9488);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            transition: background 0.5s, color 0.5s;
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
            position: relative;
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
        
        /* Style spécifique pour la carte d'édition de profil */
        .profile-edit-card {
            background: var(--card-bg);
            border-radius: 12px;
            padding: 40px;
            border: 1px solid var(--shadow-light);
            box-shadow: 0 4px 15px var(--shadow-dark);
        }

        .form-label {
            color: var(--text-color);
            font-weight: 500;
        }

        /* Personnalisation de l'affichage de l'image de profil pour l'édition */
        .profile-image-section {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-image-section img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--accent-color);
        }
        
        /* Boutons personnalisés */
        .btn-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary:hover {
            background-color: #25a7e3;
            border-color: #25a7e3;
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
    
    <div class="admin-profile">
     
       
        <p>{{ $adminRole ?? 'Admin Principal' }}</p>
    </div>


    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
     
        <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Utilisateurs</a>
        <a href="{{ route('admin.vehicles.index') }}"><i class="bi bi-car-front-fill"></i> Véhicules</a>
        <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt"></i> Transactions</a>
        <a href="{{ route('admin.loans.index') }}"><i class="bi bi-calendar-check"></i> Locations</a>
        <a href="{{ route('admin.profile') }}" ><i class="bi bi-person-badge"></i> Mon Profil</a>
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
        <h2><i class="bi bi-person-circle me-2"></i> Mon Profil</h2>
        
        <div class="d-flex align-items-center gap-3">
            <button id="mode-toggle" title="Changer de Mode">
                <i class="bi bi-sun-fill" id="mode-icon"></i>
            </button>
            <p class="mb-0 text-muted d-none d-md-block"> <i class="bi bi-calendar"></i> Aujourd'hui : {{ date('d F Y') }}</p>
        </div>
    </div>

    {{-- 💡 NOUVEAU CONTENU : Formulaire de Profil 💡 --}}
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-edit-card">
                <h4 class="mb-4" style="color: var(--accent-color);">Gérer mes informations</h4>

                {{-- Le formulaire doit être de type POST et accepter les fichiers (enctype) --}}
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Utilisez la méthode PUT/PATCH pour la mise à jour --}}

                    <div class="mb-4">
                        <label class="form-label">Image de Profil Actuelle</label>
                        <div class="profile-image-section">
                            <img id="current-profile-pic" src="{{ $adminProfilePic ?? 'https://via.placeholder.com/120/38bdf8/ffffff?text=AD' }}" alt="Image de profil">
                            
                            {{-- Champ de téléversement d'image --}}
                            <div class="flex-grow-1">
                                <label for="profile_image" class="form-label">Téléverser une nouvelle image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image" accept="image/*">
                                <small class="text-muted">Max 2MB. Format JPG ou PNG.</small>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom Complet</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $adminName ?? 'Nom de l\'Admin' }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="role" class="form-label">Rôle</label>
                            {{-- Afficher le rôle non éditable pour les permissions --}}
                            <input type="text" class="form-control" id="role" value="{{ $adminRole ?? 'Admin Principal' }}" disabled>
                            <small class="text-muted">Rôle défini par le système.</small>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="presentation" class="form-label">Présentation / Bio</label>
                        <textarea class="form-control" id="presentation" name="presentation" rows="4">{{ $adminPresentation ?? 'Je suis le principal administrateur de la plateforme AutoGestion, en charge de la supervision globale des opérations.' }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        <i class="bi bi-save me-2"></i> Enregistrer les modifications
                    </button>
                </form>
            </div>
        </div>
    </div>
    {{-- Fin de la section Profil --}}

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const toggleButton = document.getElementById('mode-toggle');
    const modeIcon = document.getElementById('mode-icon');
    
    // 1. Gestion du thème (inchangée)
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

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('light-mode');
        const isLightMode = body.classList.contains('light-mode');
        
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

    // 2. Prévisualisation de l'image lors du téléversement
    const profileImageInput = document.getElementById('profile_image');
    const currentProfilePic = document.getElementById('current-profile-pic');
    
    if (profileImageInput) {
        profileImageInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentProfilePic.src = e.target.result;
                    // Mise à jour de l'image dans la sidebar aussi (pour l'effet immédiat)
                    document.querySelector('.admin-profile .profile-pic').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>

</body>
</html>




