<!DOCTYPE html>
<html lang="en">
<head>
@include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-background {
            background-color: #f0f8f0; /* Light green background */
            color: #333;
        }
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
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Dark green icons */
        }
        .table-hover tbody tr:hover {
            background-color: #f1f2f6; /* Light grey on hover */
        }
        .btn-success {
            background-color: #4CAF50; /* Dark green button */
            border-color: #4CAF50;
        }
        .btn-outline-warning {
            color: #f39c12;
            border-color: #f39c12;
        }
        .btn-outline-danger {
            color: #e74c3c;
            border-color: #e74c3c;
        }
        .btn-success:hover, .btn-outline-warning:hover, .btn-outline-danger:hover {
            opacity: 0.9; /* Slight opacity on hover */
        }
        .btn-red {
            background-color: red; /* Red background */
            color: white; /* White text */
        }
        .highlight {
            background-color: red; /* Highlight color */
            color: white; /* White text */
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
        @endif

        <div class="custom-container">
            <h2 class="custom-title"><i class="fas fa-lightbulb icon"></i> Conseils Économie d'Énergie</h2>

            <!-- Button to create new ConseilE -->
            <div class="text-end mb-3">
                <a href="{{ route('conseils.create') }}" class="btn btn-success mb-3" id="add-conseil-btn"><i class="fas fa-plus"></i> Ajouter Nouveau Conseil</a>
            </div>

            <!-- Table to display the list of conseils -->
            <table class="table table-hover align-middle" id="conseil-table">
                <thead class="table-light">
                    <tr>
                        <th>Description du Conseil</th>
                        <th>Économie Potentielle Kwh</th>
                        <th>Fournisseur</th> <!-- Nouvelle colonne pour le fournisseur -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($conseils as $conseilE)
                    <tr>
                        <td>{{ $conseilE->description }}</td>
                        <td>{{ $conseilE->economies }}</td>
                        <td>{{ $conseilE->fournisseur ? $conseilE->fournisseur->nom : 'Non spécifié' }}</td> <!-- Afficher le nom du fournisseur -->
                        <td>
                            <!-- Action buttons -->
                            <a href="{{ route('conseils.edit', $conseilE->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Éditer</a>
                            <form action="{{ route('conseils.destroy', $conseilE->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-close success message after 6 seconds
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                const alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 6000);

            // Highlight the new conseil row
            highlightNewConseil();
        }

        function highlightNewConseil() {
            const tableBody = document.querySelector('#conseil-table tbody');
            const newRow = tableBody.lastElementChild; // Assuming the last row is the new conseil
            if (newRow) {
                newRow.classList.add('highlight'); // Add highlight class
                setTimeout(() => {
                    newRow.classList.remove('highlight'); // Remove highlight class after 2 seconds
                }, 2000);
            }
        }
    </script>
</body>
</html>
@include('frontoffice.footer')
