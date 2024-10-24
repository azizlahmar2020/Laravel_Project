<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontoffice.navbar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Transports</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .highlight {
            background-color: #C3DCDC; /* Highlight color */
            transition: background-color 0.5s ease; /* Smooth animation */
        }
        .custom-container {
            background-color: #f8f9fa; /* Light background */
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .custom-title {
            color: #343a40;
            font-weight: bold;
        }
        .custom-background {
            background-color: #f0f8f0;
            min-height: 100vh;
        }
        #transport-table thead {
            background-color: #f1f3f5;
        }
    </style>
</head>
<body class="custom-background">

    <div class="container mt-5">
 <!-- Barre de recherche -->
 <div class="mb-4">
        <input type="text" id="search-input" class="form-control" placeholder="Recherche par propriétaire ou type de transport.." onkeyup="filterTable()">
    </div>
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="custom-container">
            <h2 class="custom-title"><i class="fas fa-bus icon"></i> Liste des Transports</h2>
            @if(auth()->user()->name === 'Admin')

            <div class="text-end mb-3">
                <a href="{{ route('transports.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i>Ajouter un Transport
                </a>
                <a href="{{ route('transports.statistics') }}" class="btn custom-stats-button mb-3 ms-2">
                    <i class="fas fa-chart-line"></i> Statistiques
                </a>
            </div>
@endif

            <!-- Check if there are any transports -->
            @if($transports->isEmpty())
                <p>Pas de transport disponible.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="transport-table">
                    <thead class="table-light">
                        <tr>
                            <th>Propriétaire</th>
                            <th>Type</th>
                            <th>Distance (km) <i class="fas fa-sort-up" onclick="sortTable(2, 'asc')"></i> <i class="fas fa-sort-down" onclick="sortTable(2, 'desc')"></i></th>
                            <th>Emission de CO2 (g) <i class="fas fa-sort-up" onclick="sortTable(3, 'asc')"></i> <i class="fas fa-sort-down" onclick="sortTable(3, 'desc')"></i></th>
                            <th>Coût ($) <i class="fas fa-sort-up" onclick="sortTable(4, 'asc')"></i> <i class="fas fa-sort-down" onclick="sortTable(4, 'desc')"></i></th>
                            <th>Durée (heure) <i class="fas fa-sort-up" onclick="sortTable(5, 'asc')"></i> <i class="fas fa-sort-down" onclick="sortTable(5, 'desc')"></i></th>
                            @if(auth()->user()->name === 'Admin')
                            <th>Actions</th>
                            @endif
                        </tr>
                    </thead>

                        <tbody>
                            @foreach ($transports as $transport)
                                <tr id="transport-{{ $transport->id }}">
                                    <td>{{ $transport->owner ? $transport->owner->name : 'N/A' }}</td>
                                    <td>{{ $transport->type }}</td>
                                    <td>{{ $transport->distance }}</td>
                                    <td>{{ $transport->emissions_CO2 }}</td>
                                    <td>{{ $transport->cost }}</td>
                                    <td>{{ $transport->duration }}</td>
                                    @if(auth()->user()->name === 'Admin')
                                    <td>
                                
            <a href="{{ route('transports.show', $transport->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                        <!-- Edit button -->
                                        <a href="{{ route('transports.editTransport', $transport->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> </a>

                                        <!-- Delete button -->
                                        <form action="{{ route('transports.destroy', $transport->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this transport?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> 
                                            </button>
                                        </form>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="calculationsModal" tabindex="-1" role="dialog" aria-labelledby="calculationsModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calculationsModalLabel">Consommation du Transport</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p id="co2Display"></p>
                    <p id="costDisplay"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 4000);
            }

            // Afficher la modal avec les calculs
            @if (session('calculations'))
                document.getElementById('co2Display').textContent = 'Impact CO2 : {{ session('calculations')['emissions_CO2'] }} g';
                document.getElementById('costDisplay').textContent = 'Coût : {{ session('calculations')['cost'] }} $';
                const calculationsModal = new bootstrap.Modal(document.getElementById('calculationsModal'));
                calculationsModal.show();
            @endif
        });
    </script>
</body>
</html>
@include('frontoffice.footer')
<script>
function sortTable(columnIndex, order) {
    const table = document.getElementById('transport-table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.rows);

    rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent.trim();
        const bText = b.cells[columnIndex].textContent.trim();
        
        const aValue = parseFloat(aText) || aText; // Utiliser float pour les chiffres, ou la valeur brute pour le texte
        const bValue = parseFloat(bText) || bText;

        if (order === 'asc') {
            return aValue > bValue ? 1 : -1;
        } else {
            return aValue < bValue ? 1 : -1;
        }
    });

    // Réinsérer les lignes triées dans le tbody
    rows.forEach(row => tbody.appendChild(row));
}

function filterTable() {
    const input = document.getElementById('search-input').value.toLowerCase();
    const table = document.getElementById('transport-table');
    const rows = table.getElementsByTagName('tr');

    for (let i = 1; i < rows.length; i++) { // Ignorer l'entête du tableau
        const owner = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
        const type = rows[i].getElementsByTagName('td')[1].textContent.toLowerCase();

        if (owner.includes(input) || type.includes(input)) {
            rows[i].style.display = ''; // Afficher la ligne si elle correspond
        } else {
            rows[i].style.display = 'none'; // Masquer la ligne si elle ne correspond pas
        }
    }
}

</script>
<style>

.custom-stats-button {
        background-color: #28a745; /* Custom green color */
        color: white; /* Text color */
        border: none; /* Remove border */
    }

    .custom-stats-button:hover {
        background-color: #218838; /* Darker shade on hover */
    }
</style>