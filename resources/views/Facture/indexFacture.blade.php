<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factures</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>
 <!-- Navbar Start -->
 @include('frontoffice.navbar')
    <!-- Navbar End -->
<body>
    <div class="container mt-5">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        <h2 class="text-center mb-4">List of Factures</h2>

        <a href="{{ route('facture.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Facture</a>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Consommateur</th>
                    <th>Date de Facture</th>
                    <th>Période de Facture</th>
                    <th>Consommation Totale (kWh)</th>
                    <th>Prix Unitaire (€)</th>
                    <th>Montant Totale (€)</th>
                    <th>Type d'Énergie</th>
                    <th>Émission de Carbone (tonnes)</th>
                    <th>Moyen de Paiement</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($factures as $facture)
                <tr>
                    <td>{{ $facture->consommateur}}</td> <!-- Assuming 'name' is a property of the Consommateur model -->
                    <td>{{ $facture->date_facture }}</td>
                    <td>{{ $facture->periode_facture }}</td>
                    <td>{{ $facture->consommation_totale }}</td>
                    <td>{{ $facture->prix_unitaire }}</td>
                    <td>{{ $facture->montant_totale }}</td>
                    <td>{{ $facture->type_energie }}</td>
                    <td>{{ $facture->emission_carbone }}</td>
                    <td>{{ $facture->moyen_paiement }}</td>
                    <td>{{ $facture->statut }}</td>
                    <td>
                        <a href="{{ route('facture.edit', $facture->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('facture.destroy', $facture->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
