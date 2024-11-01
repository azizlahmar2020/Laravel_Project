<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
    /* Couleur noire pour tous les textes par défaut */
    .navbar-nav .nav-link {
        color: #000000 !important;
    }

    /* Couleur verte pour les éléments actifs et au survol */
    .navbar-nav .nav-link.active,
    .navbar-nav .nav-link:hover {
        color: #4CAF50 !important;
    }

    /* Texte "Solartec" en vert */
    .navbar-brand h2 {
        color: #4CAF50 !important;
    }

    /* Bouton avec fond vert et texte noir pour "Get A Quote" */
    .btn-custom-green {
        background-color: #4CAF50 !important;
        border-color: #4CAF50 !important;
    }

    /* Couleur légèrement plus sombre pour le hover sur le bouton */
    .btn-custom-green:hover {
        background-color: #45a049 !important;
        border-color: #45a049 !important;
    }

    /* Couleur noire pour le texte "Get A Quote" */
    .btn-custom-green span {
        color: #000000 !important;
    }

    /* Couleur blanche pour l'icône dans le bouton */
    .fa-arrow-right {
        color: #ffffff !important;
    }
</style>

<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="/dashboard" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <!-- Texte Solartec en vert -->
        <h2 class="m-0">Solartec</h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <!-- Liens de navigation en noir, deviennent verts lorsqu'ils sont actifs ou survolés -->
            <a href="/dashboard" class="nav-item nav-link active">Home</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu bg-light m-0">
                    <a href="/Logement" class="dropdown-item">Logement</a>
                    <a href="/Electros" class="dropdown-item">Electroménager</a>
                    <a href="{{ route('energyconso.index') }}" class="dropdown-item">Consumption</a>
                    <a href="/fournisseurs" class="dropdown-item">Fournisseur</a>
                    <a href="/conseils" class="dropdown-item">Conseil</a>
                    <a href="/facture" class="dropdown-item">Facture</a>
                    <a href="/source" class="dropdown-item">Source</a>
                    <a href="/Feedbacks/All" class="dropdown-item">Feedback</a>
                    <a href="/transports/" class="dropdown-item">Transport</a>
                </div>
            </div>
            <a href="" class="nav-item nav-link">About</a>
            <a href="" class="nav-item nav-link">Service</a>
            <a href="/profile" class="nav-item nav-link">Profile</a>

            <!-- Bouton de déconnexion -->
            <form method="POST" action="{{ route('logout') }}" class="nav-item">
    @csrf
    <button type="submit" class="btn btn-custom-green rounded-0 py-4 px-lg-5 d-none d-lg-block"
            style="color: #000000; text-decoration: none; background-color: #ffc107; border: none; display: flex; align-items: center;">
        <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i> <!-- Icône Font Awesome -->
        Logout
    </button>
</form>

        </div>

    </div>
</nav>
