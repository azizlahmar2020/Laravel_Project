<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Source</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Custom Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">
</head>

<body class="custom-background">

    <div class="container mt-5">
        <h2 class="text-center mb-4">Détails de la Source d'énergie renouvelable</h2>

        <div class="card">
            <div class="card-header">
                {{ $source->nom_renouv }}
            </div>
            <div class="card-body">
                <p><strong>Description :</strong> {{ $source->desc_renouv }}</p>
                <p><strong>Puissance Max :</strong> {{ $source->puissMax_renouv }} kW</p>
                <p><strong>Date de commission :</strong> {{ $source->date_renouv }}</p>
                <p><strong>Type d'énergie :</strong> {{ $source->typeE_renouv }}</p>
                <p><strong>Production estimée :</strong> {{ $source->prodEstime_renouv }} kWh</p>
                <p><strong>Coût d'installation :</strong> {{ $source->coutInstall_renouv }} €</p>
                <p><strong>Impact CO2 :</strong> {{ $source->impactCO2_renouv }} tonnes</p>
                <p><strong>Propriétaire :</strong> {{ $source->owner ? $source->owner->name : 'N/A' }}</p>

                <a href="{{ route('source.index') }}" class="btn btn-primary">Retour à la liste</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    @include('frontoffice.footer')
</body>

</html>
