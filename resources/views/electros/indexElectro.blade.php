<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electros List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .highlight {
            background-color: #C3DCDC; /* Couleur de surbrillance */
            transition: background-color 0.5s ease; /* Animation pour un effet plus doux */
        }
    </style>
</head>
<body class="custom-background">
    @include('frontoffice.navbar')

    <div class="container mt-5">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session()->get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('status'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert" id="status-alert">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session()->has('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" id="danger-alert">
                {{ session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="custom-container">
            <h2 class="custom-title"><i class="fas fa-plug icon"></i> Electros List</h2>

            <div class="text-end mb-3">
                <div class="row">
                    <div class="col-md-4"> <!-- Colonne pour le formulaire de recherche -->
                        <div class="mb-3">
                            <input type="text" id="search-input" class="form-control" placeholder="Rechercher un Electros...">
                        </div>
                    </div>
                    
                    <div class="col-md-8 text-end"> <!-- Colonne pour le bouton d'ajout -->
                    @if(auth()->user()->name === 'Admin')

                        <a href="{{ route('Electros.create') }}" class="btn btn-success mb-3" id="add-electro-btn">
                            <i class="fas fa-plus"></i> Add New Electro
                        </a>
                        @endif
                        <button class="btn btn-info mb-3" id="showStatistics">
                            <i class="fas fa-chart-bar"></i> Voir Statistiques
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                @if ($electros->isEmpty())
                    <div class="alert alert-warning">Aucun logement trouvé pour "{{ request()->get('search') }}"</div>
                @else
                    <table class="table table-hover align-middle" id="electro-table">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Puissance</th>
                                <th>Durée</th>
                                <th>Consommation</th>
                                <th>Logement</th>
                                @if(auth()->user()->name === 'Admin')

                                <th>Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($electros as $electro)
                            <tr id="electro-{{ $electro->id_electro }}">
                                <td>{{ ucfirst($electro->type) }}</td>
                                <td>{{ $electro->puissance }} W</td>
                                <td>{{ $electro->duree }} h</td>
                                <td>{{ $electro->consomation }} kWh</td>
                                <td>{{ $electro->logement->address ?? 'N/A' }}</td>
                                @if(auth()->user()->name === 'Admin')

                                <td>
                                    <a href="{{ route('electros.editElectro', $electro->id_electro) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <form action="{{ route('Electros.destroy', $electro->id_electro) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal pour les statistiques -->
    <div class="modal fade" id="statisticsModal" tabindex="-1" aria-labelledby="statisticsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statisticsModalLabel">Statistiques des Équipements Électriques</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="statisticsContent">
                        <p>Chargement des statistiques...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery must be loaded first -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            const alertElements = {
                success: $('#success-alert'),
                danger: $('#danger-alert'),
                status: $('#status-alert'),
            };

            function hideAlert(alertElement) {
                if (alertElement.length) {
                    setTimeout(() => {
                        const alert = new bootstrap.Alert(alertElement[0]);
                        alert.close();
                    }, 4000);
                }
            }

            // Hide alerts
            Object.values(alertElements).forEach(hideAlert);

            // Highlight la ligne modifiée ou ajoutée
            const highlightElectroId = '{{ session('highlight') ?? '' }}'; // ID à surligner depuis la session
            if (highlightElectroId) {
                const rowToHighlight = $('#electro-' + highlightElectroId);
                if (rowToHighlight.length) {
                    rowToHighlight.addClass('highlight');
                    setTimeout(() => {
                        rowToHighlight.removeClass('highlight');
                    }, 2000);
                }
            }

            // Charger les statistiques dans le modal
            $('#showStatistics').on('click', function() {
                $.get('{{ route("electros.statistics") }}', function(data) {
                    $('#statisticsContent').html(data);
                    $('#statisticsModal').modal('show');
                });
            });

            // Filter table rows based on search input
            $('#search-input').on('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                $('#electro-table tbody tr').each(function() {
                    const row = $(this);
                    const fournisseurName = row.find('td').eq(0).text().toLowerCase();
                    const energyType = row.find('td').eq(1).text().toLowerCase();

                    if (fournisseurName.includes(searchTerm) || energyType.includes(searchTerm)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });
    </script>


    @include('frontoffice.footer') <!-- Footer inclus dans le body -->
</body>

</html>
