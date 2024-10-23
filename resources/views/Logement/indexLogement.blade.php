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

            <div class="text-end mb-3">
                <a href="{{ route('Logement.create') }}" class="btn btn-success mb-3" id="add-logement-btn"><i class="fas fa-plus"></i> Add New Logement</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle" id="logement-table">
                    <thead class="table-light">
                        <tr>
                            <th>Address</th>
                            <th>Type</th>
                            <th>Superficie</th>
                            <th>Number of Inhabitants</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logements as $logement)
                        <tr id="logement-{{ $logement->id }}">
                            <td>{{ $logement->address }}</td>
                            <td>{{ ucfirst($logement->type) }}</td>
                            <td>{{ $logement->superficie }} m²</td>
                            <td>{{ $logement->nbr_habitant }}</td>
                            <td>
                                <a href="{{ route('Logement.edit', $logement->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('Logement.destroy', $logement->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
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
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>    <script>
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
                    }, 2000);
                }
            }
        });
    </script>
    {{ $logements->links() }} <!-- Afficher les liens de pagination -->

</body>
@include('frontoffice.footer')
</html>
