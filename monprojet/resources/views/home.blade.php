<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AutoGestion - Location & Vente Premium</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        /* === 1. VARIABLES GLOBALES (Palette Luxe/Tech) === */
        :root {
            --primary-color: #0d9488; /* Turquoise/Teck */
            --secondary-color: #FFC300; /* Jaune/Or pour l'accent */
            --bg-page: #0f172a; /* Bleu Nuit Profond */
            --bg-dark-section: #1e293b; /* Section plus foncée */
            --bg-card: rgba(255, 255, 255, 0.08);
            --text-light: #f1f5f9;
            --text-muted: #94a3b8;
            --header-bg: rgba(10, 15, 25, 0.7);
            --promo-badge-bg: #dc3545; /* Rouge pour la promo */
        }

        body {
            margin: 0;
            font-family: "Poppins", sans-serif;
            background: var(--bg-page);
            color: var(--text-light);
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #0f172a, #1e293b, #0d9488);
            background-size: 400% 400%;
            animation: gradientBG 12s ease infinite;
            z-index: -1;
            opacity: 0.8;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* === 2. HEADER/TOPBAR === */
        .topbar {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 18px 40px;
            backdrop-filter: blur(8px);
            background: var(--header-bg);
            border-bottom: 1px solid rgba(255,255,255,0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .topbar h1 {
            margin: 0;
            font-size: 27px;
            font-weight: 700;
            color: var(--secondary-color);
        }
        .topbar h1 i {
            color: var(--primary-color);
            margin-right: 5px;
        }

        .topbar a {
            margin-left: 25px;
            color: var(--text-light);
            text-decoration: none;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s ease;
            position: relative;
        }

        .topbar a:hover {
            color: var(--secondary-color);
        }
        .topbar a.btn-cta {
             background: var(--primary-color);
             color: var(--bg-page);
             padding: 8px 18px;
             border-radius: 8px;
             font-weight: 600;
        }
        .topbar a.btn-cta:hover {
            background: #10b981;
            color: var(--bg-page);
        }


        /* === 3. HERO (Nouvelle image + animation) === */
    /* === 3. HERO (Fond garanti affiché) === */
    .hero {
        height: 100vh;
        /* Remplacement de l'URL externe par le chemin local, traité par Blade */
        background: url("{{ asset('images/istockphoto-1412904420-612x612.jpg') }}") center/cover no-repeat;
        
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

        .hero-overlay {
            position: absolute;
            inset: 0;
       background: rgba(0, 0, 0, 0.75);   
       
        }

        .hero-content {
            position: relative;
            text-align: center;
            max-width: 800px;
            padding: 20px;
            animation: slide-up 1s ease forwards;
            opacity: 0;
        }

        @keyframes slide-up {
            0% { transform: translateY(30px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 600;
            text-shadow: 0 5px 20px rgba(0,0,0,0.8);
        }
/* Règle générale pour toutes les images du contenu (non seulement les cartes) */
    img {
        max-width: 100%; /* S'assure que l'image ne dépasse jamais la largeur de son parent */
        height: auto;    /* Conserve le ratio hauteur/largeur pour éviter la déformation */
        display: block;  /* Aide à la mise en page et élimine l'espace blanc sous l'image */
    }

    /* === 3. HERO (Nouvelle image + animation) === */
    .hero {
        height: 100vh;
        /* ... autres styles ... */
        /* Assurez-vous que l'image de fond couvre bien toute la section */
        background-size: cover; 
        background-position: center;
        background-repeat: no-repeat;
    }
        .hero-content p {
            font-size: 17px;
            margin-top: 20px;
            opacity: 0.95;
            color: var(--secondary-color);
        }

        .btn-main, .btn-light-custom {
            padding: 14px 32px;
            font-size: 18px;
            border-radius: 10px;
            font-weight: 700;
            transition: 0.3s ease, transform 0.2s;
            text-transform: uppercase;
        }
        .btn-main {
            background: var(--primary-color);
            color: var(--bg-page);
            border: 2px solid var(--primary-color);
        }
        .btn-main:hover {
            background: transparent;
            color: var(--primary-color);
            transform: translateY(-2px);
        }
        .btn-light-custom {
            background: transparent;
            border: 2px solid var(--text-light);
            color: var(--text-light);
        }
        .btn-light-custom:hover {
            background: var(--text-light);
            color: var(--bg-page);
            transform: translateY(-2px);
        }

        /* === 4. SECTIONS COMMUNES === */
        section {
            padding: 80px 0;
        }
        .section-title {
            text-align: center;
            font-size: 38px;
            font-weight: 800;
            margin-bottom: 50px;
            color: var(--secondary-color);
            border-bottom: 3px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 10px;
            display: inline-block;
        }
        .section-title i {
            color: var(--primary-color);
        }

        /* CARDS */
        .car-card {
            position: relative;
            background: var(--bg-card);
            border-radius: 15px;
            padding: 18px;
            text-align: center;
            transition: 0.3s;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .car-card:hover {
            transform: scale(1.03);
            background: rgba(255,255,255,0.15);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .car-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }

        /* NOUVEAU: Style pour la carte de promotion */
        .promo-card {
            border: 3px solid var(--primary-color);
            background: linear-gradient(145deg, var(--bg-dark-section), #111827);
        }
        .promo-card .badge-promo {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--promo-badge-bg);
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            font-weight: 700;
            font-size: 0.9rem;
            z-index: 5;
            transform: rotate(3deg);
            box-shadow: 0 2px 5px rgba(0,0,0,0.4);
        }
        .old-price {
            text-decoration: line-through;
            color: var(--text-muted);
            font-size: 0.95rem;
            margin-right: 10px;
        }
        .new-price {
            color: var(--secondary-color);
            font-size: 1.25rem;
            font-weight: 700;
        }
        /* Styles de l'équipe */
        #staff-team { background-color: var(--bg-page); }
        .staff-card { 
            background: var(--bg-dark-section); 
            border-radius: 15px; 
            padding: 20px; 
            text-align: center; 
            transition: 0.3s; 
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); 
        }
        .staff-img { 
            /* 👇 RÈGLE CRUCIALE : CERCLE, TAILLE FIXE ET COUVERTURE */
            width: 150px; 
            height: 150px; 
            border-radius: 50%; /* Rend l'image parfaitement ronde */
            object-fit: cover; /* Assure que l'image remplit la zone sans déformation */
            margin-bottom: 15px; 
            border: 4px solid var(--secondary-color); 
            transition: 0.3s; 
        }
        .staff-card:hover .staff-img { border-color: var(--primary-color); }
        /* Styles des autres sections (About Us, Staff) inchangés pour la concision */
        #about-us { background-color: var(--bg-dark-section); border-top: 5px solid var(--primary-color); text-align: center; }
        #about-us p { font-size: 1.1rem; line-height: 1.8; max-width: 900px; margin: 0 auto; color: var(--text-muted); }
        #staff-team { background-color: var(--bg-page); }
        .staff-card { background: var(--bg-dark-section); border-radius: 15px; padding: 20px; text-align: center; transition: 0.3s; box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3); }
        .staff-card img { border: 4px solid var(--secondary-color); }
        .testimonial { background: var(--bg-dark-section); border-left: 4px solid var(--secondary-color); padding: 20px; border-radius: 10px; margin-bottom: 25px; }


        /* NOUVEAU: Section Contact/Adresse */
        #contact-info {
            background-color: #1a2333;
            padding: 50px 0;
        }
        .info-card {
            background: var(--bg-page);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.4);
        }
        .info-card h4 {
            color: var(--primary-color);
            font-weight: 700;
            margin-bottom: 20px;
        }
        .map-container {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            margin-top: 20px;
        }

        footer {
            margin-top: 0;
            padding: 35px 0;
            background: #0d1320;
            text-align: center;
            color: var(--text-muted);
            border-top: 1px solid rgba(255,255,255,0.1);
        }
    </style>
</head>

<body>

<header class="topbar">
    <h1> AutoGestion</h1>

    <nav>
        <a href="#about-us">Mission</a>
        <a href="#staff-team">L'Équipe</a>
     <a href="#vehicles">Flotte</a>
        <a href="#contact-info">Contact</a> <a href="{{ route('login') }}" class="btn-cta">Connexion</a>
    </nav>
</header>

<section class="hero">
    <div class="hero-overlay"></div>

    <div class="hero-content">
        <h1>Location & Vente de véhicules haut de gamme</h1>
        <p>Fiabilité, performance et luxe. Commencez votre expérience premium en toute confiance.</p>

        <div class="mt-5">
            <a href="#december-offers" class="btn-main me-3">Découvrir les offres</a>
            <a href="{{ route('register') }}" class="btn-light-custom">Créer mon compte</a>
        </div>
    </div>
</section>

<section class="container" id="december-offers">
    <h2 class="section-title"><i class="fas fa-gift me-2"></i> 🎁 Offres Spéciales de Décembre 🎁</h2>
    <p class="text-center mb-5 lead" style="color: var(--text-muted);">
        Profitez de nos baisses de prix exceptionnelles pour les fêtes !
    </p>

    <div class="row g-4 justify-content-center">
        @foreach([
            {{-- REMPLACÉ PAR VOS CHEMINS LOCAUX (dans public/images/) --}}
            ['img'=> asset('images/j1.jpg'),'name'=>'Range Rover Evoque','old_price'=>'150 USD / Jour','new_price'=>'110 USD / Jour'],
            ['img'=> asset('images/temerario-mobile.jpg'),'name'=>'Porsche Cayenne 2020','old_price'=>'250 USD / Jour','new_price'=>'199 USD / Jour'],
            ['img'=> asset('images/j2.jpg'),'name'=>'Audi Q5 Luxe','old_price'=>'90 USD / Jour','new_price'=>'75 USD / Jour'],
        ] as $promo)
            <div class="col-lg-4 col-md-6">
                <div class="car-card promo-card">
                    {{-- Calcul du pourcentage --}}
                    @php
                        $old = (float)str_replace([' USD / Jour', ' '], '', $promo['old_price']);
                        $new = (float)str_replace([' USD / Jour', ' '], '', $promo['new_price']);
                        $percent = round(($old - $new) / $old * 100);
                    @endphp
                    <span class="badge-promo">-{{ $percent }}%</span>
                    
                    <img src="{{ $promo['img'] }}" alt="Image de {{ $promo['name'] }}">
                    <h5 class="mt-3">{{ $promo['name'] }}</h5>
                    <div>
                        <span class="old-price">{{ $promo['old_price'] }}</span>
                        <span class="new-price">{{ $promo['new_price'] }}</span>
                    </div>
                    <a href="{{ route('login') }}" class="btn-main mt-3 w-100">Réserver l'offre</a>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section id="about-us" class="py-5">
    <div class="container">
        <h2 class="section-title"><i class="fas fa-handshake me-2"></i> Notre Mission</h2>
        
        <p>
            Chez AutoGestion, nous croyons que l'accès à la mobilité de luxe ne devrait pas être compliqué. 
            Fondée en 2023, notre plateforme est le pont entre vous et le véhicule de vos rêves, qu'il s'agisse 
            d'une location ponctuelle pour un événement ou d'un achat permanent. Nous garantissons une flotte 
            maintenue aux plus hauts standards et un service client irréprochable.
        </p>
        <p class="mission-title">
            "Notre engagement : Vous offrir une expérience de conduite inoubliable."
        </p>
    </div>
</section>
<section id="staff-team" class="container">
    <h2 class="section-title"><i class="fas fa-users-cog me-2"></i> L'Équipe derrière AutoGestion</h2>

    <div class="row g-4 justify-content-center">
        @foreach([
            ['name' => 'Jocelyn Youvens Dions', 'title' => 'PDG & Fondateur', 'img_url' => asset('images/IMG_20251103_163607_971~2.jpg')], 
            ['name' => 'Lafleur Jean Samuel', 'title' => 'Directeur des Opérations', 'img_url' => asset('images/IMG-20250207-WA0001.jpg')],
            ['name' => 'Eserve Mondy', 'title' => 'Chef Mécanicien', 'img_url' => asset('images/IMG-20250207-WA0002~2.jpg')],
            ['name' => 'Léa Martin', 'title' => 'Relations Clients', 'img_url' => asset('images/user.png')],
        ] as $member)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="staff-card">
                    {{-- La classe .staff-img doit garantir le cercle via CSS --}}
                    <img src="{{ $member['img_url'] }}" alt="Photo de {{ $member['name'] }}" class="staff-img"> 
                    <h5>{{ $member['name'] }}</h5>
                    <p>{{ $member['title'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section class="container" id="vehicles">
    <h2 class="section-title"><i class="fas fa-car me-2"></i> Flotte de Véhicules Standard</h2>

    <div class="row g-4">
        @foreach([
            ['img'=>'https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&w=800&q=80','name'=>'Toyota RAV4 2022','price'=>'45 USD / Jour'],
            ['img'=>'https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&w=800&q=80','name'=>'Mercedes GLE 2023','price'=>'120 USD / Jour'],
            ['img'=>'https://images.unsplash.com/photo-1504215680853-026ed2a45def?auto=format&w=800&q=80','name'=>'BMW Série 3 2021','price'=>'95 USD / Jour'],
        ] as $car)
            <div class="col-md-4">
                <div class="car-card">
                    <img src="{{ $car['img'] }}" alt="Image de {{ $car['name'] }}">
                    <h5 class="mt-3">{{ $car['name'] }}</h5>
                    <p class="fw-bold" style="color: var(--secondary-color) !important;">{{ $car['price'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<section id="contact-info">
    <div class="container">
        <h2 class="section-title"><i class="fas fa-map-marker-alt me-2"></i> Notre Agence</h2>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-10">
                <div class="info-card">
                    
                    {{-- 1. CONTACT & LOCALISATION --}}
                    <h4><i class="fas fa-building me-2"></i> Contact & Localisation</h4>
                    <p><i class="fas fa-location-arrow me-2" style="color: var(--primary-color);"></i> Adresse Principale : Simon, Arrondissement des Cayes, Haïti</p>
                    <p><i class="fas fa-phone me-2" style="color: var(--primary-color);"></i> Téléphone : +509 40 16 03 35</p>
                    <p><i class="fas fa-envelope me-2" style="color: var(--primary-color);"></i> Email : contact@autogestion.ht</p>
                    
                    <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">

                    {{-- 2. HORAIRES (Plus visible) --}}
                    <h4><i class="fas fa-clock me-2"></i> Horaires d'Ouverture</h4>
                    <p>
                        <i class="fas fa-calendar-alt me-2" style="color: var(--secondary-color);"></i> 
                        Lundi - Vendredi : 08h00 - 17h00
                    </p>
                    <p>
                        <i class="fas fa-calendar-day me-2" style="color: var(--secondary-color);"></i> 
                        Samedi : 08h00 - 13h00 (Sur rendez-vous)
                    </p>

                    <hr style="border-top: 1px solid rgba(255, 255, 255, 0.1);">
                    
                    {{-- 3. RÉSEAUX SOCIAUX (Nouveauté) --}}
                    <h4><i class="fas fa-share-alt me-2"></i> Suivez-nous</h4>
                    <div class="d-flex mt-3">
                        {{-- Instagram --}}
                        <a href="#VOTRE_LIEN_INSTAGRAM" target="_blank" class="me-3" style="font-size: 24px; color: var(--text-light); transition: 0.3s;">
                            <i class="fab fa-instagram"></i>
                        </a>
                        {{-- Facebook --}}
                        <a href="#VOTRE_LIEN_FACEBOOK" target="_blank" class="me-3" style="font-size: 24px; color: var(--text-light); transition: 0.3s;">
                            <i class="fab fa-facebook"></i>
                        </a>
                        {{-- TikTok --}}
                        <a href="#VOTRE_LIEN_TIKTOK" target="_blank" style="font-size: 24px; color: var(--text-light); transition: 0.3s;">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-10 mt-4 mt-lg-0">
                <div class="map-container">
                    {{-- Intégration de la carte iframe (N'oubliez pas d'utiliser votre propre code d'intégration) --}}
                    <iframe 
                        src="https://www.google.com/maps?q=Dexia+8+Enfas+Dexia+%236+Cayes+Sud+Haiti&output=embed" 
                        width="100%" 
                        height="450" 
                        style="border:0; border-radius: 10px;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="container" id="testimonials">
    <h2 class="section-title"><i class="fas fa-comments me-2"></i> Témoignages des clients</h2>

    <div class="row g-4">
        @foreach([
            ['name'=>'Jean Pierre','msg'=>'Service exceptionnel ! Voitures très propres et neuves. Le processus de location est un jeu d\'enfant.'],
            ['name'=>'Marie Laurent','msg'=>'Expérience premium, la Mercedes était impeccable. L\'équipe de support est très réactive.'],
            ['name'=>'David Toussaint','msg'=>'Support rapide, prix raisonnables pour la qualité. Je recommande fortement AutoGestion à tous.'],
        ] as $t)
            <div class="col-md-4">
                <div class="testimonial">
                    <p class="mb-3">"{{ $t['msg'] }}"</p>
                    <small class="fw-bold" style="color: var(--primary-color) !important;">— {{ $t['name'] }}</small>
                </div>
            </div>
        @endforeach
    </div>
</section>

<footer>
    <p>© {{ date('Y') }} AutoGestion — Location & Vente Premium. Tous droits réservés.</p>
    <p class="mt-2 small" style="color: var(--primary-color);">Simon, Cayes, Haïti</p>
</footer>

</body>
</html>