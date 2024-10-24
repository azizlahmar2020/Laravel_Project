<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Include the navbar -->
    @include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sources d'énergie renouvelable</title>

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
  <!-- Champ de recherche -->
  <div class="mb-3">
                <input type="text" id="search-input" class="form-control" placeholder="Rechercher par nom de source...">
            </div>
        <div class="custom-container">

            <h2 class="custom-title text-center mb-4"><i class="fas fa-solar-panel"></i>Liste des sources d'énergie renouvelable</h2>
            @if(auth()->user()->name === 'Admin')

            <div class="text-end mb-3">
                <a href="{{ route('source.create') }}" class="btn btn-success mb-3" id="add-source-btn">
                    <i class="fas fa-plus"></i>Ajouter une Source
                </a>
            </div>
@endif
            <div class="table-responsive">
                <table class="table table-hover align-middle" id="source-table">
                    <thead class="table-light">
                        <tr>
                            <th>Nom de la source</th>
                            <th>Description</th>
                            <th>Puissance Max (kW)</th>
                            <th>Type d'énergie</th>
                            <th>Production éstimée(kWh)</th>
                            <th>Coût d'installation(€)</th>
                            <th>Impact de CO2 (tonnes)</th>
                            <th>Consommateur</th>
                            @if(auth()->user()->name === 'Admin')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sources as $source)
                        <tr id="source-{{ $source->id }}">
                            <td>{{ $source->nom_renouv }}</td>
                            <td>{{ $source->desc_renouv }}</td>
                            <td>{{ $source->puissMax_renouv }}</td>
                            <td>{{ $source->typeE_renouv }}</td>
                            <td>{{ $source->prodEstime_renouv }}</td>
                            <td>{{ $source->coutInstall_renouv }}</td>
                            <td>{{ $source->impactCO2_renouv }}</td>
                            <td >{{ $source->owner ? $source->owner->email : 'N/A' }}</td>

                            <td>
                            <a href="{{ route('source.show', $source->id) }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-eye"></i> Voir
                            </a>
                            @if(auth()->user()->name === 'Admin')

                                <a href="{{ route('source.edit', $source->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('source.destroy', $source->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
@endif
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

            const highlightSourceId = '{{ session('highlight') }}';
            if (highlightSourceId) {
                const rowToHighlight = document.getElementById(`source-${highlightSourceId}`);
                if (rowToHighlight) {
                    rowToHighlight.classList.add('highlight');
                    setTimeout(() => {
                        rowToHighlight.classList.remove('highlight');
                    }, 2000);
                }
            }
       // Recherche par nom de source
       const searchInput = document.getElementById('search-input');
            const sourceTable = document.getElementById('source-table');
            const rows = sourceTable.getElementsByTagName('tr');

            searchInput.addEventListener('keyup', function() {
                const filter = searchInput.value.toLowerCase();

                // Boucle à travers toutes les lignes du tableau
                for (let i = 1; i < rows.length; i++) { // Commencer à 1 pour ignorer l'en-tête
                    const cells = rows[i].getElementsByTagName('td');
                    let found = false;

                    // Vérifiez chaque cellule de la ligne
                    for (let j = 0; j < cells.length; j++) {
                        if (cells[j].textContent.toLowerCase().includes(filter)) {
                            found = true; // Si la cellule contient le texte de recherche
                            break; // Pas besoin de vérifier les autres cellules
                        }
                    }

                    // Afficher ou masquer la ligne selon la recherche
                    rows[i].style.display = found ? '' : 'none';
                }
            });
        });
    </script>

    @include('frontoffice.footer')
</body>

</html>
