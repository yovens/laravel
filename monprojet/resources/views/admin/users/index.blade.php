<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Utilisateurs - AutoGestion Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* === 1. VARIABLES (Dark Mode par défaut) === */
        :root {
            --sidebar-width: 260px;
            --bg-color: #1a202c; /* Fond principal sombre */
            --sidebar-bg: #2d3748; /* Fond Sidebar légèrement plus clair */
            --accent-color: #38bdf8; /* Couleur d'accent (Bleu Ciel - Utilisateurs) */
            --card-bg: rgba(45, 55, 72, 0.95); /* Fond Card translucide (pour la table) */
            --text-color: #e2e8f0;
            --link-color: #a0aec0; /* Couleur des liens inactifs */
            --hover-bg: rgba(255, 255, 255, 0.05); /* Fond clair pour le hover */
            --shadow-light: rgba(255, 255, 255, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.6);
            --border-color: rgba(255, 255, 255, 0.15);
        }

        /* === 1B. VARIABLES LIGHT MODE === */
        body.light-mode {
            --bg-color: #f7fafc; /* Fond clair */
            --sidebar-bg: #ffffff; /* Sidebar blanc */
            --card-bg: #ffffff; /* Fond Card blanc opaque */
            --text-color: #2d3748; /* Texte sombre */
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --border-color: rgba(0, 0, 0, 0.1);
            --link-color: #4a5568; 
        }

        body.light-mode {
            background: var(--bg-color); 
            animation: none;
            opacity: 1;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex;
            min-height: 100vh;
            transition: background 0.5s, color 0.5s;
            
            /* Styles d'animation Dark Mode 
            background: linear-gradient(135deg, #0f172a, #1e293b, #0d9488);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            z-index: -1;
            opacity: 0.95;  */
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ==== 2. SIDEBAR (Navigation Latérale - Ultra Stylée) ==== */
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color); 
            padding: 20px 0;
            box-shadow: 4px 0 15px var(--shadow-dark);
            transition: all 0.5s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }

        .sidebar h1 {
            font-size: 24px;
            font-weight: 800;
            padding: 0 25px 20px;
            color: var(--accent-color);
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        .sidebar-nav {
            flex-grow: 1;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            margin: 3px 15px;
            border-radius: 10px;
            color: var(--link-color);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .sidebar-nav a i {
            margin-right: 15px;
            font-size: 19px;
            color: var(--link-color);
            transition: color 0.3s;
        }

        .sidebar-nav a:hover {
            background: var(--hover-bg);
            color: var(--text-color);
            transform: translateX(5px);
        }

        .sidebar-nav a:hover i {
            color: var(--accent-color);
        }

        /* Style Actif (Effet Ligne Magique) */
        .sidebar-nav a.active {
            background: linear-gradient(90deg, var(--accent-color) 0%, rgba(56, 189, 248, 0.15) 100%);
            color: var(--bg-color);
            font-weight: 700;
            box-shadow: 0 4px 10px rgba(56, 189, 248, 0.2);
            transform: none;
        }

        .sidebar-nav a.active i {
            color: var(--bg-color);
        }

        .sidebar-nav a.active::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 5px;
            background-color: var(--accent-color);
            border-radius: 10px 0 0 10px;
            animation: fadein 0.5s ease-out; 
        }
        @keyframes fadein {
            from { opacity: 0; transform: scaleY(0.5); }
            to { opacity: 1; transform: scaleY(1); }
        }


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

        /* TABLE CUSTOM STYLES */
        .table-dark thead th {
            color: var(--bg-color); 
            background-color: var(--accent-color);
            border-color: rgba(0,0,0,0.2);
        }
        
        .table-dark {
             /* Mode Sombre (Dark Mode) par défaut */
            
             --bs-table-hover-bg: rgba(255, 255, 255, 0.1);
             border-color: rgba(255, 255, 255, 0.1);
             color: #333; /* 🔥 Corrigé: Utilise la couleur du texte (blanc en Dark Mode) */
        }
        
        /* Light Mode Table adjustments */
        body.light-mode .table-dark {
         
            --bs-table-hover-bg: #f0f0f0ff;
            color: #333; /* 🔥 Corrigé: Force le texte à utiliser la couleur sombre du Light-Mode */
            border-color: var(--border-color);
        }

        
        body.light-mode .table-dark thead th {
            color: #fff; 
        }
        body.light-mode .table-dark tr {
            border-color: var(--border-color) !important;
        }


        /* ==== 5. BOUTON LOGOUT / MODALS ==== */
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

        /* Formulaires/Modal styles */
        .modal-content {
            background: var(--sidebar-bg) !important; 
            color: var(--text-color);
        }
        .modal-header, .modal-footer {
            border-color: var(--border-color) !important;
        }
        .form-control, .form-select {
            background: var(--bg-color) !important; 
            border-color: var(--border-color) !important; 
            color: var(--text-color) !important;
        }
        /* Fix pour l'icône de fermeture en mode sombre */
        .modal-content .btn-close {
            filter: invert(1);
        }
        /* Fix pour l'icône de fermeture en mode clair */
        body.light-mode .modal-content .btn-close {
            filter: none;
        }
        
        /* Ajustement des couleurs des champs de formulaire en mode clair */
        body.light-mode .form-control, body.light-mode .form-select {
            background: #fff !important; 
            border-color: var(--border-color) !important; 
            color: var(--text-color) !important; /* Texte sombre */
        }
    </style>
</head>

<body>

<div class="sidebar">
  <br>
  <br>
    <h1><i class="bi bi-gear-fill me-2"></i> AutoGestion </h1>
<br>
    <div class="sidebar-nav">
        <a href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer"></i> Dashboard</a>
        <a href="{{ route('admin.users.index') }}" class="active"><i class="bi bi-people"></i> Utilisateurs</a>
        <a href="{{ route('admin.vehicles.index') }}"><i class="bi bi-car-front-fill"></i> Véhicules</a>
        <a href="{{ route('admin.transactions.index') }}"><i class="bi bi-receipt"></i> Transactions</a>
        <a href="{{ route('admin.loans.index') }}"><i class="bi bi-calendar-check"></i> Locations</a>
         <a href="{{ route('admin.profile') }}" ><i class="bi bi-person-badge"></i> Mon Profil</a>
    </div>

    {{-- Bouton de Déconnexion en bas de la sidebar --}}
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
        <h2 class="fw-bold"><i class="bi bi-people me-2"></i> Gestion des Utilisateurs</h2>
        
        <div class="d-flex align-items-center gap-3">
            {{-- Bouton de changement de mode --}}
            <button id="mode-toggle" title="Changer de Mode">
                <i class="bi bi-sun-fill" id="mode-icon"></i>
            </button>
            <p class="mb-0 text-muted d-none d-md-block"><i class="bi bi-calendar"></i> Aujourd'hui : {{ date('d F Y') }}</p>
        </div>
    </div>

    <p class="intro">
        Sur cette page, vous pouvez ajouter, modifier, bloquer ou supprimer les comptes utilisateurs et gérer leurs rôles sur la plateforme AutoGestion.
    </p>

    {{-- BOUTON AJOUTER --}}
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary" style="background-color: var(--accent-color); border-color: var(--accent-color); color: var(--bg-color); font-weight: 600;" 
                data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="bi bi-person-plus-fill"></i> Ajouter Utilisateur
        </button>
    </div>

    {{-- TABLEAU DE GESTION (DARK/LIGHT MODE) --}}
    <div class="table-responsive shadow-lg rounded" style="border-radius: 12px; overflow: hidden; background: var(--card-bg); border: 1px solid var(--shadow-light);">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr style="border-color: var(--border-color);">
                    <td class="text-muted">{{ $u->id }}</td>
                    <td>{{ $u->nom }}</td>
                    <td>{{ $u->email }}</td>
                    <td>
                        <span class="badge {{ $u->role=='ADMIN'?'bg-warning text-dark':'bg-info' }}">
                            {{ $u->role }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $u->status=='ACTIVE'?'bg-success':'bg-danger' }}">
                            {{ $u->status }}
                        </span>
                    </td>
                    <td class="d-flex gap-2">
                        <button class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#editUserModal{{$u->id}}" title="Modifier">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.users.block',$u->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-secondary" type="submit" 
                                    title="{{ $u->status=='ACTIVE'?'Bloquer':'Débloquer' }}" 
                                    style="background-color: rgba(255,255,255,0.2); border: none;">
                                <i class="bi {{ $u->status=='ACTIVE'?'bi-lock-fill':'bi-unlock-fill' }}"></i>
                            </button>
                        </form>
                        <form method="POST" action="{{ route('admin.users.destroy',$u->id) }}">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit" title="Supprimer">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                {{-- MODAL DE MODIFICATION (EDIT) --}}
                <div class="modal fade" id="editUserModal{{$u->id}}" tabindex="-1">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <form method="POST" action="{{ route('admin.users.update',$u->id) }}">
                        @csrf @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title" style="color: var(--accent-color);">Modifier Utilisateur : {{ $u->nom }}</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                          <input type="text" name="nom" value="{{ $u->nom }}" class="form-control mb-3" placeholder="Nom" required>
                          <input type="email" name="email" value="{{ $u->email }}" class="form-control mb-3" placeholder="Email" required>
                          <select name="role" class="form-select mb-3">
                            <option value="CLIENT" {{ $u->role=='CLIENT'?'selected':'' }}>CLIENT</option>
                            <option value="ADMIN" {{ $u->role=='ADMIN'?'selected':'' }}>ADMIN</option>
                          </select>
                          <select name="status" class="form-select">
                            <option value="ACTIVE" {{ $u->status=='ACTIVE'?'selected':'' }}>ACTIVE</option>
                            <option value="BLOCKED" {{ $u->status=='BLOCKED'?'selected':'' }}>BLOCKED</option>
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
                          <button class="btn btn-success"><i class="bi bi-check-lg"></i> Enregistrer</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MODAL DE CRÉATION (CREATE) --}}
    <div class="modal fade" id="createUserModal" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" style="color: var(--accent-color);">Ajouter Utilisateur</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <input type="text" name="nom" class="form-control mb-3" placeholder="Nom" required>
              <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
              <input type="password" name="password" class="form-control mb-3" placeholder="Mot de passe" required>
              <select name="role" class="form-select mb-3">
                <option value="CLIENT">CLIENT</option>
                <option value="ADMIN">ADMIN</option>
              </select>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-success">Créer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const toggleButton = document.getElementById('mode-toggle');
    const modeIcon = document.getElementById('mode-icon');
    
    // 1. Détermine le mode par défaut au chargement
    const savedMode = localStorage.getItem('theme') || 'dark';

    function setMode(mode) {
        if (mode === 'light') {
            body.classList.add('light-mode');
            modeIcon.classList.remove('bi-sun-fill');
            modeIcon.classList.add('bi-moon-fill');
            localStorage.setItem('theme', 'light');
        } else {
            body.classList.remove('light-mode');
            modeIcon.classList.add('bi-sun-fill');
            modeIcon.classList.remove('bi-moon-fill');
            localStorage.setItem('theme', 'dark');
        }
    }

    // Appliquer le mode sauvegardé
    setMode(savedMode);

    // 2. Événement de bascule
    toggleButton.addEventListener('click', () => {
        const currentMode = body.classList.contains('light-mode') ? 'light' : 'dark';
        const newMode = currentMode === 'light' ? 'dark' : 'light';
        setMode(newMode);
    });
});
</script>

</body>
</html>