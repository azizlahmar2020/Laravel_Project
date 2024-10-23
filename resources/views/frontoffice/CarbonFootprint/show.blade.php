<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f9;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            width: 80%;
            margin: 30px auto;
            background-color: white;
            box-shadow: 0 4px 8px rgba(10, 202, 129, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .invoice-header {
            background-color: #36b305;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .invoice-header h1 {
            margin: 0;
            font-size: 36px;
            letter-spacing: 2px;
        }

        .invoice-body {
            padding: 30px;
        }

        .invoice-body .company-info {
            text-align: right;
        }

        .invoice-body .company-info p {
            margin: 0;
            color: #333;
        }

        .invoice-details {
            margin-top: 40px;
        }

        .invoice-details h3 {
            border-bottom: 2px solid #1c6d3b;
            padding-bottom: 5px;
            margin-bottom: 20px;
            color: #1d3557;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }

        .invoice-table th {
            background-color: #f4f4f4;
            color: #1d3557;
        }

        .invoice-summary {
            text-align: right;
            margin-top: 20px;
        }

        .invoice-summary .total {
            font-size: 24px;
            color: #1d3557;
            font-weight: bold;
        }

        .invoice-footer {
            background-color: #f4f7f9;
            padding: 20px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .invoice-footer p {
            margin: 0;
        }

        .invoice-footer .contact-info {
            margin-top: 10px;
            font-size: 12px;
        }

        /* Custom style for the pie chart */
        #consumptionPieChart {
            max-width: 400px;
            /* Adjust max-width as needed */
            margin: 0 auto;
            /* Center the chart */
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <div class="invoice-container">
        <!-- Header Section -->
        <div class="invoice-header">
            <h1>Invoice</h1>
        </div>

        <!-- Body Section -->
        <div class="invoice-body">

            <!-- Company Information -->
            <div class="company-info">
                <p><strong>Solartec</strong></p>
                <p>123 Ghazela, Ariana, Tunisie</p>
                <p>Email: solartec@company.com | Phone: +123 456 789</p>
            </div>

            <!-- Invoice Details -->
            <div class="invoice-details">
                <h3>Carbon Footprint Summary</h3>

                <!-- Invoice Table -->
                <table class="invoice-table">
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Electricity Carbon Emission</td>
                            <td>{{ number_format($carbon_footprint->electricity_carbon_emission, 2) }}</td>
                            <td>$0.233</td>
                            <td>${{ number_format($carbon_footprint->electricity_carbon_emission * 0.233, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Gas Carbon Emission</td>
                            <td>{{ number_format($carbon_footprint->gas_carbon_emission, 2) }}</td>
                            <td>$2.30</td>
                            <td>${{ number_format($carbon_footprint->gas_carbon_emission * 2.3, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Heating Oil Carbon Emission</td>
                            <td>{{ number_format($carbon_footprint->heating_oil_carbon_emission, 2) }}</td>
                            <td>$2.68</td>
                            <td>${{ number_format($carbon_footprint->heating_oil_carbon_emission * 2.68, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Summary Section -->
                <div class="invoice-summary">
                    <p>Subtotal:
                        ${{ number_format($carbon_footprint->electricity_carbon_emission * 0.233 + $carbon_footprint->gas_carbon_emission * 2.3 + $carbon_footprint->heating_oil_carbon_emission * 2.68, 2) }}
                    </p>
                    <p>Tax (10%):
                        ${{ number_format(($carbon_footprint->electricity_carbon_emission * 0.233 + $carbon_footprint->gas_carbon_emission * 2.3 + $carbon_footprint->heating_oil_carbon_emission * 2.68) * 0.1, 2) }}
                    </p>
                    <p class="total">Total Carbon Footprint:
                        {{ number_format($carbon_footprint->total_carbon_footprint, 2) }} kgCO₂</p>
                </div>
            </div>
        </div>

        <!-- New Section for Consumption Statistics -->
        <div class="invoice-details">
            <!-- Pie Chart for Consumption -->
            <h3>Consumption Statistique</h3>
            <canvas id="consumptionPieChart"></canvas>
        </div>

        <!-- Recommendations Section -->
        <div class="invoice-details">
            <h3>Recommendations for Reducing Carbon Emissions</h3>
            <ul>
                <li>Consider switching to renewable energy sources such as solar or wind power.</li>
                <li>Reduce electricity usage by turning off lights and unplugging devices when not in use.</li>
                <li>Opt for energy-efficient appliances and LED lighting.</li>
                <li>Use public transportation, carpool, or bike to reduce reliance on fossil fuels.</li>
                <li>Implement a regular maintenance schedule for heating systems to ensure efficiency.</li>
                <li>Reduce water heating costs by setting your water heater to a warm setting.</li>
                <li>Encourage plant-based meals to lower carbon emissions associated with meat production.</li>
                <li>Engage in carbon offset programs or support reforestation initiatives.</li>
            </ul>
        </div>


        <!-- Footer Section -->
        <div class="invoice-footer">
            <p>Thank you for your business!</p>
            <div class="contact-info">
                <p>If you have any questions about this invoice, please contact:</p>
                <p>Email: support@company.com | Phone: +123 456 789</p>
            </div>
        </div>
    </div>

    <script>
        // Data for different consumptions
        const electricityConsumption = 140.4;
        const gasConsumption = 150.2;
        const heatingOilConsumption = 240.3;
        const solarEnergyGenerated = 2;

        const totalCarbonFootprint = 2702.62;

        if (totalCarbonFootprint > 0) {
            const electricityPercentage = (electricityConsumption / totalCarbonFootprint) * 100;
            const gasPercentage = (gasConsumption / totalCarbonFootprint) * 100;
            const heatingOilPercentage = (heatingOilConsumption / totalCarbonFootprint) * 100;
            const solarEnergyPercentage = (solarEnergyGenerated / totalCarbonFootprint) * 100;

            // Create the Pie Chart
            const ctx = document.getElementById('consumptionPieChart').getContext('2d');
            const consumptionPieChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Electricity (kWh)', 'Gas (m³)', 'Heating Oil (liters)', 'Solar Energy (kWh)'],
                    datasets: [{
                        data: [electricityPercentage, gasPercentage, heatingOilPercentage,
                            solarEnergyPercentage
                        ],
                        backgroundColor: ['#4e79a7', '#f28e2c', '#e15759', '#76b7b2'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(2) + '%';
                                }
                            }
                        }
                    }
                }
            });
        } else {
            console.error('Total carbon footprint is zero or undefined. No chart data to display.');
        }
    </script>



</body>

</html>
