<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Feedbacks</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body.custom-background {
            background-color: #f0f8f0; /* Light gray background */
            color: #333;
        }
        .custom-title {
            text-align: center;
            color: #4CAF50; /* Bootstrap Info color */
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .custom-container {
            background: #ffffff; /* White container */
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 470px; /* Set max width for the card */
            margin: auto; /* Center the card */
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Bootstrap Info color */
        }
        .footer-btn {
            margin-top: 10px;
            text-align: end;
        }
    </style>
</head>
<body class="custom-background">
    @include('frontoffice.navbar')

    <h2 class="custom-title"><i class="fas fa-chart-pie"></i> Statistiques des Feedbacks</h2>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="custom-container">
                    <canvas id="feedbackChart"></canvas>
                </div>
            </div>
            <div class="footer-btn">
            <a href="{{ route('feedbacks.all') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
        </div>
     
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('feedbackChart').getContext('2d');
        const feedbackChart = new Chart(ctx, {
            type: 'pie', // Type de graphique
            data: {
                labels: @json($labels), // Étoiles de 1 à 5
                datasets: [{
                    label: 'Nombre de Feedbacks',
                    data: @json($data), // Données pour le graphique
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Distribution des Évaluations par Étoiles'
                    }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
