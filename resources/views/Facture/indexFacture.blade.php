<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include the navbar -->
    @include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Factures</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Additional Libraries -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .highlight {
            background-color: #C3DCDC; /* Highlight color */
            transition: background-color 0.5s ease; /* Smooth transition */
        }
    </style>
</head>

<body class="custom-background">

    <div class="container mt-5">
    <div class="mb-3">
                <input type="text" id="search-input" class="form-control" placeholder="Recherche par nom...">
            </div>

        <!-- Success and other alert messages -->
        @if (session()->get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session()->get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (session('status'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="status-alert">
            {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif (session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
            {{ session('danger') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="custom-container">
            <h2 class="custom-title text-center mb-4"><i class="fas fa-file-invoice"></i> Listes des factures</h2>


            @if(auth()->user()->name === 'Admin')

            <div class="text-end mb-3">
                <a href="{{ route('facture.create') }}" class="btn btn-success mb-3" id="add-facture-btn"><i class="fas fa-plus"></i> Ajouter une Facture</a>
            </div>
@endif
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="facture-table">
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
                            @if(auth()->user()->name === 'Admin')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($factures as $facture)
                        <tr id="facture-{{ $facture->id }}">
                        <td>{{ $facture->owner ? $facture->owner->name : 'N/A' }}</td>
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
                            <a href="{{ route('facture.show', $facture->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i> </a>
                            @if(auth()->user()->name === 'Admin')
                            <a href="{{ route('facture.edit', $facture->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> </a>
                                <form action="{{ route('facture.destroy', $facture->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> </button>
                                </form>
                                <a href="{{ route('facture.exportPdf', $facture->id) }}" class="btn btn-outline-primary btn-sm">
        <i class="fas fa-file-pdf"></i> 
       @endif
    </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and additional libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successAlert = document.getElementById('success-alert');
            const dangerAlert = document.getElementById('danger-alert');
            const statusAlert = document.getElementById('status-alert');

            // Function to hide alerts after a certain time
            function hideAlert(alertElement) {
                if (alertElement) {
                    setTimeout(() => {
                        const alert = new bootstrap.Alert(alertElement);
                        alert.close();
                    }, 4000);
                }
            }

            hideAlert(successAlert);
            hideAlert(dangerAlert);
            hideAlert(statusAlert);

            // Highlight the recently modified or added row
            const highlightFactureId = '{{ session('highlight') }}';
            if (highlightFactureId) {
                const rowToHighlight = document.getElementById(`facture-${highlightFactureId}`);
                if (rowToHighlight) {
                    rowToHighlight.classList.add('highlight');
                    setTimeout(() => {
                        rowToHighlight.classList.remove('highlight');
                    }, 2000);
                }
            }
        });
       
        document.getElementById('search-input').addEventListener('keyup', function() {
            let searchValue = this.value.toLowerCase();
            let rows = document.querySelectorAll('#facture-table tbody tr');

            rows.forEach(row => {
                let consommateur = row.querySelector('td:first-child').textContent.toLowerCase();
                if (consommateur.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

    </script>

</body>

<!-- Include the footer -->
@include('frontoffice.footer')

</html>
