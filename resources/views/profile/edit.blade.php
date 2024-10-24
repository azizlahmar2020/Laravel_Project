<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        /* Navbar styling */
        .navbar-nav .nav-link {
            color: #000000 !important;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:hover {
            color: #4CAF50 !important;
        }

        .navbar-brand h2 {
            color: #4CAF50 !important;
        }

        .btn-custom-green {
            background-color: #4CAF50 !important;
            border-color: #4CAF50 !important;
        }

        .btn-custom-green:hover {
            background-color: #45a049 !important;
            border-color: #45a049 !important;
        }

        .btn-custom-green span {
            color: #000000 !important;
        }

        .fa-arrow-right {
            color: #ffffff !important;
        }

        /* Profile section styling */
        .profile-section {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
        }

        .profile-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-align: center;
        }

        .profile-card h2 {
            color: #333;
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .profile-card p {
            color: #777;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }

        /* Input field styling */
        input, textarea {
            border-radius: 8px !important;
            border: 1px solid #ccc !important;
            padding: 10px;
            font-size: 1rem;
            margin-bottom: 15px;
            width: 100%;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
        <a href="/dashboard" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
            <h2 class="m-0">Solartec</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
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

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}" class="nav-item">
                    @csrf
                    <button type="submit" class="btn btn-custom-green rounded-0 py-4 px-lg-5 d-none d-lg-block"
                            style="color: #000000; text-decoration: none; display: flex; align-items: center;">
                        <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <div class="container profile-section">
        <div class="profile-card">
            <!-- Display user name -->
            <h2>Welcome, {{ Auth::user()->name }}!</h2>
            <p>Manage your profile information below.</p>

            <!-- Update Profile Form -->
            <div class="mt-4">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password Form -->
            <div class="mt-4">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account Form -->
            <div class="mt-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
