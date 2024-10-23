<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils List</title>
<!-- Include jsPDF library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">     
    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
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
        /* Style for QR Code container */
        .qr-code {
            display: none; /* Hidden by default */
            margin-top: 10px;
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

            <!-- Champ de recherche -->
            <div class="mb-3">
                <input type="text" id="search-input" class="form-control" placeholder="Rechercher un conseil...">
            </div>

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
                            <!-- QR Code button -->
                            <button class="btn btn-outline-info btn-sm" onclick="generateQRCodeForText('{{ $conseilE->description }}', {{ $conseilE->economies }}, {{ $conseilE->id }})"><i class="fas fa-qrcode"></i> QR Code</button>
                            <div class="qr-code" id="qr-code-{{ $conseilE->id }}"></div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- QRious for QR Code generation -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
    <script>
        // Auto-close success message after 6 seconds
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            setTimeout(() => {
                const alert = new bootstrap.Alert(successAlert);
                alert.close();
            }, 6000);
        }

        // Filtrage dynamique
        document.getElementById('search-input').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#conseil-table tbody tr');

            tableRows.forEach(row => {
                const description = row.cells[0].textContent.toLowerCase();
                const fournisseurName = row.cells[2].textContent.toLowerCase(); // Nom du fournisseur

                if (description.includes(searchTerm) || fournisseurName.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Fonction pour générer un QR Code qui déclenche un téléchargement de texte
        function generateQRCodeForText(description, economies, conseilId) {
    const qrCodeContainer = document.createElement('canvas');
    const qrCodeId = 'qr-code-' + conseilId;
    document.getElementById(qrCodeId).innerHTML = '';
    document.getElementById(qrCodeId).appendChild(qrCodeContainer);

    // Create the content to display
    const contentText = `Conseil: ${description}\nÉconomie: ${economies} kWh`;

    // Generate the QR code directly from the content text
    const qr = new QRious({
        element: qrCodeContainer,
        value: contentText, // Directly use the content text
        size: 200,
    });

    // Display the QR code
    const qrCodeDiv = document.getElementById(qrCodeId);
    qrCodeDiv.style.display = 'block'; 

    // Create a Blob for the text content
    const blob = new Blob([contentText], { type: 'text/plain' });
    const textFileUrl = URL.createObjectURL(blob);

    // Create download link for text file
    const textDownloadLink = document.createElement('a');
    textDownloadLink.href = textFileUrl;
    textDownloadLink.download = `conseil_${conseilId}.txt`; // Name of the text file
    textDownloadLink.innerText = 'Télécharger le fichier texte';
    qrCodeDiv.appendChild(textDownloadLink);

    // Create download link for PDF
    const pdfDownloadLink = document.createElement('a');
    pdfDownloadLink.innerText = 'Télécharger le PDF';
    pdfDownloadLink.style.marginLeft = '10px'; // Add some space between links
    qrCodeDiv.appendChild(pdfDownloadLink);

    // Create PDF when the link is clicked
    pdfDownloadLink.onclick = function() {
        // Use jsPDF to create a PDF document
        const { jsPDF } = window.jspdf; // Ensure to get jsPDF from the window object
        const pdf = new jsPDF();

        // Set font and add content
        pdf.setFont("helvetica", "normal");
        pdf.setFontSize(12);
        pdf.text(contentText, 10, 10); // Add text to the PDF
        pdf.save(`conseil_${conseilId}.pdf`); // Save the PDF
    };
}

    </script>
    <div class="d-flex justify-content-center mt-4">
        {{ $conseils->links() }}
    </div>

</body>

@include('frontoffice.footer')

</html>
