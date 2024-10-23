<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Transports</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-background {
            background-color: #f0f8f0; /* Light gray background */
            color: #333;
        }
        .custom-title {
            text-align: center;
            color: #4CAF50; /* Bootstrap Info color */
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .custom-container {
            background: #ffffff; /* White container */
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Bootstrap Info color */
        }
    </style>
</head>
<body class="custom-background">
    @include('frontoffice.navbar')

    <h2 class="custom-title"><i class="fas fa-chart-bar"></i> Statistiques des Transports</h2>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="custom-container">
                    <h3>Coût par type de transport</h3>
                    <canvas id="costChart"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="custom-container">
                    <h3>Impact CO2 par type de transport</h3>
                    <canvas id="consumptionChart"></canvas>
                </div>
            </div>
        </div>
        <div class="text-end mt-3">
                <a href="{{ route('transports.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data passed from the controller to JavaScript
        const types = @json(array_keys($costByType->toArray()));
        const costByType = @json($costByType->values());
        const consumptionByType = @json($consumptionByType->values());

        // Cost Chart
        const ctxCost = document.getElementById('costChart').getContext('2d');
        const costChart = new Chart(ctxCost, {
            type: 'bar',
            data: {
                labels: types,
                datasets: [{
                    label: 'Coût Total ($)',
                    data: costByType,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // CO2 Emissions Chart
        const ctxConsumption = document.getElementById('consumptionChart').getContext('2d');
        const consumptionChart = new Chart(ctxConsumption, {
            type: 'bar',
            data: {
                labels: types,
                datasets: [{
                    label: 'Émissions CO2 Totales (g)',
                    data: consumptionByType,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
