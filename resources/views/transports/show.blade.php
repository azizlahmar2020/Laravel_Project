<!DOCTYPE html>
<html lang="fr">
<head>
    @include('frontoffice.navbar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Transport</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">

    <style>
        .custom-background {
            background-color: #f0f8f0;
        }
        .card-header {
            font-weight: bold;
            font-size: 1.25rem;
        }
        .card-body p {
            margin-bottom: 0.75rem;
        }
    </style>
</head>
<body class="custom-background">

<div class="container mt-5">
    <h2 class="text-center mb-4">Détails du Transport</h2>

    <div class="card">
        <div class="card-header">
            Propriétaire : {{ $transport->owner->email ?? 'N/A' }}
        </div>
        <div class="card-body">
            <p><strong>Type de transport :</strong> {{ $transport->type }}</p>
            <p><strong>Distance :</strong> {{ $transport->distance }} km</p>
            <p><strong>Durée :</strong> {{ $transport->duration }} heures</p>
            <p><strong>Émission de CO2 :</strong> {{ $transport->emissions_CO2 }} g</p>
            <p><strong>Coût :</strong> {{ $transport->cost }} $</p>

            <div class="text-end mt-3">
                <a href="{{ route('transports.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@include('frontoffice.footer')
</body>
</html>
