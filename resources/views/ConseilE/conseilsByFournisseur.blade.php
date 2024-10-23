<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontoffice.navbar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils for {{ $fournisseur->nom }}</title>
 <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
     <!-- Libraries Stylesheet -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">    <style>
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
    </style>
</head>
<body>
    <div class="container mt-5 custom-container">
        <h2 class="custom-title">Conseils for {{ $fournisseur->nom }}</h2>

        <ul>
            @forelse ($fournisseur->conseils as $conseil)
                <li>{{ $conseil->description }} - {{ $conseil->economies }} économies</li>
            @empty
                <li>Aucun conseil trouvé pour ce fournisseur.</li>
            @endforelse
        </ul>

        <a href="{{ route('fournisseurs.index') }}" class="btn btn-secondary">Retour à la liste des fournisseurs</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@include('frontoffice.footer')
