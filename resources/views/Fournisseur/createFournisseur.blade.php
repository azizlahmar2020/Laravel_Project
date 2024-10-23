<!DOCTYPE html>
<html lang="en">
<head>
@include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fournisseur</title>
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
    <style>
        .custom-background {
            background-color: #f0f8f0; /* Light green background */
            color: #333;
        }
        .custom-container {
            background: #ffffff; /* White container */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .custom-title {
            text-align: center;
            color: #4CAF50; /* Dark green color */
        }
        .custom-label {
            font-weight: bold;
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Dark green icons */
        }
        .btn-submit {
            background-color: #4CAF50; /* Dark green submit button */
            color: white;
        }
    </style>
</head>
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-building"></i> Créer un Nouveau Fournisseur</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to create a new fournisseur -->
        <form action="{{ route('fournisseurs.store') }}" method="POST">
            @csrf

            <!-- Nom du Fournisseur Field -->
            <div class="mb-3">
                <label for="nom" class="form-label custom-label"><i class="fas fa-user icon"></i> Nom du Fournisseur</label>
                <input type="text" class="form-control" id="nom" name="nom" >
            </div>

            <!-- Type d'Énergie Field -->
            <div class="mb-3">
                <label for="type" class="form-label custom-label"><i class="fas fa-plug icon"></i> Type d'Énergie</label>
                <select class="form-control" id="type" name="type" >
                    <option value="Oil">Oil</option>
                    <option value="Coal">Coal</option>
                    <option value="Nuclear">Nuclear</option>
                    <option value="Natural Gas">Natural Gas</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <!-- Tarif Field -->
            <div class="mb-3">
                <label for="tarif" class="form-label custom-label"><i class="fas fa-money-bill-wave icon"></i> Tarif</label>
                <input type="number" class="form-control" id="tarif" name="tarif" min="0" step="0.01" >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Soumettre</button>
            <a href="/fournisseurs"  class="btn btn-danger w-100"><i class="fas fa-times"></i> cancel</a>

        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('frontoffice.footer')

</html>
