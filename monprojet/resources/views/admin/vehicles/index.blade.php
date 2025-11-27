<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Véhicules - AutoGestion Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* === 1. VARIABLES & FOND (Dark Mode Admin) === */
        :root {
            --sidebar-width: 260px;
            --bg-color: #1a202c; /* Fond principal sombre */
            --sidebar-bg: #2d3748; /* Fond Sidebar légèrement plus clair */
            --accent-color: #38bdf8; /* Couleur d'accent (bleu ciel/cyan) */
            --card-bg: rgba(45, 55, 72, 0.8); /* Fond Card translucide */
            --text-color: #e2e8f0;
            --link-hover: #ffffff;
            --shadow-light: rgba(255, 255, 255, 0.08);
            --shadow-dark: rgba(0, 0, 0, 0.5);
            /* Couleur d'accent pour les véhicules (vert clair) */
            --vehicle-accent: #4ade80; 
            --border-color: rgba(255, 255, 255, 0.1);
        }
        
        /* === 1B. VARIABLES LIGHT MODE (AJOUTÉ) === */
        body.light-mode {
            --bg-color: #f7fafc; 
            --sidebar-bg: #ffffff; 
            --card-bg: #ffffff; 
            --text-color: #2d3748; /* Texte sombre (CLÉ !) */
            --shadow-light: rgba(0, 0, 0, 0.1);
            --shadow-dark: rgba(0, 0, 0, 0.15);
            --border-color: rgba(0, 0, 0, 0.15);
            --link-color: #4a5568;
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            display: flex; 
            min-height: 100vh;
            transition: background 0.5s, color 0.5s;
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
            transition: width 0.3s;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            border-right: 1px solid var(--border-color);
        }

        .sidebar h1 {
            font-size: 22px;
            font-weight: 700;
            padding: 0 20px 20px;
            color: var(--vehicle-accent);
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
        }

        /* Accentuation pour le lien Véhicules */
        .sidebar-nav a:hover, .sidebar-nav a.active {
            background: var(--vehicle-accent);
            color: var(--bg-color); 
            box-shadow: 0 4px 10px rgba(74, 222, 128, 0.4);
        }
        
        .sidebar-nav a.active {
            font-weight: 600;
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
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }

        .content-header h2 {
            font-weight: 800;
            color: var(--vehicle-accent); /* Utilisation de l'accent vert */
        }
        
        .intro {
            font-size: 16px;
            opacity: 0.85;
            max-width: 900px;
            margin-bottom: 40px;
            padding-left: 0;
        }

        /* Style pour le bouton Mode Toggle (AJOUTÉ) */
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
            background: var(--vehicle-accent);
            color: var(--bg-color);
            border-color: var(--vehicle-accent);
        }

        /* TABLE CUSTOM STYLES (CORRIGÉ) */
        .table-dark thead th {
            color: var(--bg-color); 
            background-color: var(--vehicle-accent); /* En-tête de tableau vert */
            border-color: rgba(0,0,0,0.2);
        }
        
        .table-dark {
             /* Mode Sombre (Dark Mode) par défaut */
           
             --bs-table-hover-bg: rgba(255, 255, 255, 0.1);
             border-color: rgba(255, 255, 255, 0.1);
             color: var(--text-color); /* CLÉ : Utilise la variable du texte (blanc en Dark) */
        }

        /* Light Mode Table adjustments (AJOUTÉ) */
        body.light-mode .table-dark {
      
            --bs-table-hover-bg: #f0f0f0;
            color: var(--text-color); /* CLÉ : Assure que le texte est sombre (noir) */
            border-color: var(--border-color);
        }
        body.light-mode .table-dark thead th {
            color: #fff; /* Le texte de l'en-tête reste blanc sur le fond d'accent vert */
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

        .logout-btn:hover {
            background: #dc2626;
            transform: scale(1.02);
        }

        /* Formulaires/Modal styles */
        .modal-content {
            background: var(--sidebar-bg) !important; 
            color: var(--text-color);
        }
        .modal-header, .modal-footer {
            border-color: var(--border-color) !important;
        }
        .form-control, .form-select {
            background: #1a202c !important; 
            border-color: rgba(255,255,255,0.1) !important; 
            color: var(--text-color) !important;
        }
        /* Fix pour l'icône de fermeture en mode sombre */
        .modal-content .btn-close {
            filter: invert(1);
        }
        /* Fix pour l'icône de fermeture en mode clair (AJOUTÉ) */
        body.light-mode .modal-content .btn-close {
            filter: none !important;
        }
        
        /* Ajustement des couleurs des champs de formulaire en mode clair (AJOUTÉ) */
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
        <a href="{{ route('admin.users.index') }}"><i class="bi bi-people"></i> Utilisateurs</a>
        <a href="{{ route('admin.vehicles.index') }}" class="active"><i class="bi bi-car-front-fill"></i> Véhicules</a>
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
        <h2 class="fw-bold"><i class="bi bi-car-front-fill me-2"></i> Gestion des Véhicules</h2>
        
        <div class="d-flex align-items-center gap-3">
            {{-- Bouton de changement de mode (AJOUTÉ) --}}
            <button id="mode-toggle" title="Changer de Mode">
                <i class="bi bi-sun-fill" id="mode-icon"></i>
            </button>
            <p class="mb-0 text-muted d-none d-md-block"><i class="bi bi-calendar"></i> Aujourd'hui : {{ date('d F Y') }}</p>
        </div>
    </div>

    <p class="intro">
        Gérez l'inventaire de vos véhicules, y compris les détails, les prix de vente et de location, et le statut de disponibilité.
    </p>

    {{-- BOUTON AJOUTER --}}
    <div class="d-flex justify-content-end mb-4">
        <button class="btn btn-primary" style="background-color: var(--vehicle-accent); border-color: var(--vehicle-accent); color: var(--bg-color); font-weight: 600;" 
                data-bs-toggle="modal" data-bs-target="#createVehicleModal">
            <i class="bi bi-plus-circle-fill"></i> Ajouter Véhicule
        </button>
    </div>

    {{-- TABLEAU DE GESTION (DARK MODE) --}}
    <div class="table-responsive shadow-lg rounded" style="border-radius: 12px; overflow: hidden; background: var(--card-bg); border: 1px solid var(--shadow-light);">
        <table class="table table-dark table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marque</th>
                    <th>Modèle</th>
                    <th>Plaque</th>
                    <th>Année</th>
                    <th>Image</th>
                    <th>Prix Vente</th>
                    <th>Prix Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {{-- Assurez-vous que $vehicles est une collection/array dans votre contrôleur --}}
                @foreach($vehicles as $v)
                <tr style="border-color: var(--border-color);">
                    <td class="text-muted">{{ $v->id }}</td>
                    <td>{{ $v->brand }}</td>
                    <td>{{ $v->model }}</td>
                    <td>{{ $v->plate }}</td>
                    <td>{{ $v->year }}</td>
                    <td><img src="/storage/{{ $v->image }}" width="60" class="rounded shadow"></td>
                    <td>{{ number_format($v->price) }} USD</td>
                    <td>{{ number_format($v->loan_price) }} USD</td>
                    <td>
                        @if($v->status==1)
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-secondary">Indisponible</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-warning text-dark me-1" data-bs-toggle="modal" data-bs-target="#editVehicleModal{{$v->id}}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.vehicles.destroy',$v->id) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editVehicleModal{{$v->id}}" tabindex="-1">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <form method="POST" action="{{ route('admin.vehicles.update',$v->id) }}" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="modal-header">
                          <h5 class="modal-title" style="color: var(--vehicle-accent);">Modifier Véhicule ({{ $v->plate }})</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body row g-3">
                          <div class="col-md-6">
                            <input type="text" name="brand" value="{{ $v->brand }}" class="form-control" placeholder="Marque" required>
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="model" value="{{ $v->model }}" class="form-control" placeholder="Modèle" required>
                          </div>
                          <div class="col-md-6">
                            <input type="text" name="plate" value="{{ $v->plate }}" class="form-control" placeholder="Plaque" required>
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="year" value="{{ $v->year }}" class="form-control" placeholder="Année" required>
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="price" value="{{ $v->price }}" class="form-control" placeholder="Prix Vente" required>
                          </div>
                          <div class="col-md-6">
                            <input type="number" name="loan_price" value="{{ $v->loan_price }}" class="form-control" placeholder="Prix Location" required>
                          </div>
                          <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Image Actuelle (ne pas modifier si inchangé)</label>
                            <input type="file" name="image" class="form-control">
                          </div>
                          <div class="col-md-6">
                            <label class="form-label text-muted small mb-1">Statut</label>
                            <select name="status" class="form-select">
                                <option value="1" {{$v->status==1?'selected':''}}>Disponible</option>
                                <option value="0" {{$v->status==0?'selected':''}}>Indisponible</option>
                            </select>
                          </div>
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

    <div class="modal fade" id="createVehicleModal" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
              <h5 class="modal-title" style="color: var(--vehicle-accent);">Ajouter Nouveau Véhicule</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body row g-3">
              <div class="col-md-6"><input type="text" name="brand" class="form-control" placeholder="Marque" required></div>
              <div class="col-md-6"><input type="text" name="model" class="form-control" placeholder="Modèle" required></div>
              <div class="col-md-6"><input type="text" name="plate" class="form-control" placeholder="Plaque" required></div>
              <div class="col-md-6"><input type="number" name="year" class="form-control" placeholder="Année" required></div>
              <div class="col-md-6"><input type="number" name="price" class="form-control" placeholder="Prix Vente" required></div>
              <div class="col-md-6"><input type="number" name="loan_price" class="form-control" placeholder="Prix Location (par jour/heure)" required></div>
              <div class="col-md-6"><input type="file" name="image" class="form-control" required></div>
              <div class="col-md-6">
                <select name="status" class="form-select">
                    <option value="1">Disponible</option>
                    <option value="0">Indisponible</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Annuler</button>
              <button class="btn btn-success">Créer</button>
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