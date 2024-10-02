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
    @include('frontoffice.navbar')

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
            <h2 class="custom-title"><i class="fas fa-plug icon"></i> Electros List</h2>

            <div class="text-end mb-3">
                <a href="{{ route('Electros.create') }}" class="btn btn-success mb-3" id="add-electro-btn"><i class="fas fa-plus"></i> Add New Electro</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="electro-table">
                    <thead class="table-light">
                        <tr>
                            <th>Type</th>
                            <th>Puissance</th>
                            <th>Durée</th>
                            <th>Consommation</th>
                            <th>Logement</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($electros as $electro)
                        <tr id="electro-{{ $electro->id_electro }}">
                            <td>{{ ucfirst($electro->type) }}</td>
                            <td>{{ $electro->puissance }} W</td>
                            <td>{{ $electro->duree }} h</td>
                            <td>{{ $electro->consomation }} kWh</td>
                            <td>{{ $electro->logement->address ?? 'N/A' }}</td> <!-- Assurez-vous que 'address' existe dans votre relation -->
                            <td>
                                <a href="{{ route('electros.editElectro', $electro->id_electro) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('Electros.destroy', $electro->id_electro) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?');"><i class="fas fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
            const highlightElectroId = '{{ session('highlight') }}'; // ID à surligner depuis la session
            if (highlightElectroId) {
                const rowToHighlight = document.getElementById(`electro-${highlightElectroId}`);
                if (rowToHighlight) {
                    rowToHighlight.classList.add('highlight');
                    setTimeout(() => {
                        rowToHighlight.classList.remove('highlight');
                    }, 2000);
                }
            }
        });
    </script>
</body>
@include('frontoffice.footer')
</html>
