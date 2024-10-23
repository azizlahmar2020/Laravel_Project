<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- CSS personnalisés -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Chart.js pour les graphiques -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery pour la manipulation du DOM -->

    <!-- jsPDF et html2canvas pour la génération PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

    <script>
        $(document).ready(function () {
            // Récupération des données pour le graphique
            const logementIds = @json($consommationParAdresse->pluck('logement_id'));
            const totalConsumptions = @json($consommationParAdresse->pluck('total_consumption'));

            const ctx = document.getElementById('consumptionChart').getContext('2d');
            const consumptionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: logementIds,
                    datasets: [{
                        label: 'Consommation Totale (kWh)',
                        data: totalConsumptions,
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                fontSize: 10 // Réduction de la taille des labels
                            }
                        },
                        x: {
                            ticks: {
                                fontSize: 10 // Réduction de la taille des labels
                            }
                        }
                    }
                }
            });

            // Génération du PDF
            document.getElementById('pdfButton').addEventListener('click', function () {
                const { jsPDF } = window.jspdf;

                // Capture la partie que vous voulez convertir en PDF
                html2canvas(document.querySelector('.body_state'), { scale: 1.5 }).then(canvas => {
                    const pdf = new jsPDF('p', 'mm', 'a4');

                    const imgData = canvas.toDataURL('image/png');
                    const imgWidth = pdf.internal.pageSize.getWidth();
                    const imgHeight = canvas.height * imgWidth / canvas.width;

                    // Ajouter l'image au PDF
                    pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);
                    pdf.save('statistiques-electros.pdf');
                });
            });
        });
    </script>

    <style>
        .body_state {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0; /* Supprimer les marges pour le PDF */
            padding: 10px; /* Réduction du padding pour gagner de l'espace */
            border-radius: 5px;
            width: 100%; /* Largeur maximale pour s'adapter à A4 */
            overflow: hidden; /* Eviter le débordement */
        }

        .h1_state {
            text-align: center;
            color: #343a40;
            margin-bottom: 15px; /* Espacement réduit */
            font-size: 16px; /* Réduction de la taille de la police */
        }

        .h2_state {
            color: #343a40;
            margin-top: 10px;
            font-size: 14px; /* Réduction de la taille de la police */
        }

        .custom-table {
            margin: 5px 0; /* Espacement réduit */
            width: 100%;
            border-collapse: collapse;
        }

        .custom-table th,
        .custom-table td {
            padding: 3px; /* Réduction du padding */
            text-align: center;
            border: 1px solid #343a40;
            font-size: 10px; /* Réduction de la taille de la police */
        }

        .custom-table th {
            background-color: #e9ecef;
        }

        .chart-container {
            position: relative;
            margin: auto;
            height: 200px; /* Hauteur réduite pour s'adapter à A4 */
            max-width: 100%;
            width: 100%;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 5px; /* Réduction de l'espacement */
        }

        .btn-custom {
            margin: 0 5px; /* Espacement réduit entre les boutons */
            font-size: 10px; /* Réduction de la taille des boutons */
        }
    </style>
</head>

<body>
    <div class="body_state">
        <h1 class="h1_state">Statistiques des Électros</h1>
        <div class="button-container">
                <button id="pdfButton" class="btn btn-primary btn-custom">Télécharger en PDF</button>

            </div>
        <div class="container">
            <p><strong>Total d'électros :</strong> {{ $totalElectros }}</p>
            <p><strong>Total de consommation :</strong> {{ $totalConsommation }} kWh</p>
            <p><strong>Moyenne de puissance :</strong> {{ $averagePuissance }} W</p>

            <h2>Consommation par Adresse</h2>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Logement ID</th>
                        <th>Address</th>
                        <th>Consommation Totale (kWh)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($consommationParAdresse as $consommation)
                    <tr>
                    <td>{{ $consommation->logement_id }}</td>
                    <td>{{ $consommation->logement->address }}</td> <!-- Remplacez logement_id par l'adresse -->
                    <td>{{ $consommation->total_consumption }} kWh</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <h2 class="h2_state">Graphiques de Consommation</h2>
            <div class="chart-container">
                <canvas id="consumptionChart"></canvas>
            </div>


        </div>
    </div>
</body>

</html>
