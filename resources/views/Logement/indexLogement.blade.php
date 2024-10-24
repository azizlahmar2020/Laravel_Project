<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logements List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        .highlight {
            background-color: #C3DCDC; /* Couleur de surbrillance */
            transition: background-color 0.5s ease; /* Animation pour un effet plus doux */
        }
    </style>
</head>
<body class="custom-background">

<div class="container mt-5">
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
        <h2 class="custom-title"><i class="fas fa-home icon"></i> Logements List</h2>

        <!-- Search Bar -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="mb-3">
                    <input type="text" id="search-input" class="form-control" placeholder="Rechercher un Logement...">
                </div>
            </div>
            @if(auth()->user()->name === 'Admin')

            <div class="col-md-8 text-end">
                <a href="{{ route('Logement.create') }}" class="btn btn-success mb-3" id="add-logement-btn"><i class="fas fa-plus"></i> Add New Logement</a>
            </div>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle" id="logement-table">
                <thead class="table-light">
                    <tr>
                    <th>Adresse</th> <!-- Nouvelle colonne pour l'adresse -->

                        <th>
                            <a href="{{ route('Logement.index', ['search' => $search, 'sort_by' => 'type', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Type
                                @if($sortBy == 'type')
                                    <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'down' : 'up' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('Logement.index', ['search' => $search, 'sort_by' => 'superficie', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Superficie
                                @if($sortBy == 'superficie')
                                    <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'down' : 'up' }}"></i>
                                @endif
                            </a>
                        </th>
                        <th>
                            <a href="{{ route('Logement.index', ['search' => $search, 'sort_by' => 'nbr_habitant', 'sort_order' => $sortOrder === 'asc' ? 'desc' : 'asc']) }}">
                                Nombre d'Habitants
                                @if($sortBy == 'nbr_habitant')
                                    <i class="fas fa-sort-{{ $sortOrder === 'asc' ? 'down' : 'up' }}"></i>
                                @endif
                            </a>
                        </th>
                        @if(auth()->user()->name === 'Admin')

                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if ($logements->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">Aucun logement trouvé pour "{{ request()->get('search') }}"</td> <!-- Mise à jour du colspan -->
                        </tr>
                    @else
                        @foreach ($logements as $logement)
                        <tr id="logement-{{ $logement->id }}">
                        <td>{{ $logement->address }}</td> <!-- Affichage de l'adresse -->

                            <td>{{ ucfirst($logement->type) }}</td>
                            <td>{{ $logement->superficie }} m²</td>
                            <td>{{ $logement->nbr_habitant }}</td>
                            @if(auth()->user()->name === 'Admin')

                            <td>
                                <a href="{{ route('Logement.edit', $logement->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('Logement.destroy', $logement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script>
    document.getElementById('search-input').addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('#logement-table tbody tr');

        tableRows.forEach(row => {
            const logementType = row.cells[0].textContent.toLowerCase();
            const superficie = row.cells[1].textContent.toLowerCase();
            const adresse = row.cells[3].textContent.toLowerCase(); // Ajout de l'adresse

            if (logementType.includes(searchTerm) || superficie.includes(searchTerm) || adresse.includes(searchTerm)) { // Vérification de l'adresse dans la recherche
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const successAlert = document.getElementById('success-alert');
        const dangerAlert = document.getElementById('danger-alert');
        const statusAlert = document.getElementById('status-alert');

        // Fonction pour cacher les alertes après un certain temps
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

        // Highlight la ligne modifiée ou ajoutée
        const highlightLogementId = '{{ session('highlight') }}'; // ID à surligner depuis la session
        if (highlightLogementId) {
            const rowToHighlight = document.getElementById(`logement-${highlightLogementId}`);
            if (rowToHighlight) {
                rowToHighlight.classList.add('highlight');
                setTimeout(() => {
                    rowToHighlight.classList.remove('highlight');
                }, 3000);
            }
        }
    });
</script>
</body>
@include('frontoffice.footer') <!-- Footer inclus dans le body -->

</html>
