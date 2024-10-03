<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Transport</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .custom-background {
            background-color: #f8f9fa; /* Light gray background */
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
            color: #17a2b8; /* Bootstrap Info color */
        }
        .custom-label {
            font-weight: bold;
        }
        .icon {
            margin-right: 8px;
            color: #17a2b8; /* Bootstrap Info color */
        }
        .btn-submit {
            background-color: #17a2b8; /* Info submit button */
            color: white;
        }
        .transport-button {
            width: 30%;
            margin: 0 10px;
            text-align: center;
            border: 2px solid #17a2b8; /* Info border */
            border-radius: 8px;
            background: #fff; /* White background */
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .transport-button:hover {
            background: #17a2b8; /* Info on hover */
            color: white; /* White text on hover */
        }
    </style>
</head>
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-bus-alt"></i> Create Transport</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('transports.store') }}" method="POST">
            @csrf

            <!-- Type de Transport Buttons -->
            <div class="mb-3 text-center">
                <label class="form-label custom-label"><i class="fas fa-shuttle-van icon"></i> Type of Transport</label>
                <div class="d-flex justify-content-center">
                    <div class="transport-button" onclick="selectTransport('Vélo')">
                        <i class="fas fa-bicycle fa-2x"></i><br>Vélo
                    </div>
                    <div class="transport-button" onclick="selectTransport('Voiture')">
                        <i class="fas fa-car fa-2x"></i><br>Voiture
                    </div>
                    <div class="transport-button" onclick="selectTransport('Moto')">
                        <i class="fas fa-motorcycle fa-2x"></i><br>Moto
                    </div>
                </div>
                <input type="hidden" id="type_transport" name="type" required>
            </div>

            <!-- Distance Field -->
            <div class="mb-3">
                <label for="distance" class="form-label custom-label"><i class="fas fa-road icon"></i> Distance (in km)</label>
                <input type="range" class="form-range" id="distance" name="distance" min="0" max="200" value="0" oninput="this.nextElementSibling.value = this.value">
                <output>0</output> km
            </div>

            <!-- CO2 Emissions Field -->
            <div class="mb-3">
                <label for="emissions_CO2" class="form-label custom-label"><i class="fas fa-leaf icon"></i> CO2 Emissions (in g/km)</label>
                <input type="number" class="form-control" id="emissions_CO2" name="emissions_CO2" required>
            </div>

            <!-- Cost Field -->
            <div class="mb-3">
                <label for="cost" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i> Cost ($)</label>
                <input type="number" class="form-control" id="cost" name="cost" required>
            </div>

            <!-- Duration Field -->
            <div class="mb-3">
                <label for="duration" class="form-label custom-label"><i class="fas fa-clock icon"></i> Duration (in minutes)</label>
                <input type="number" class="form-control" id="duration" name="duration" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectTransport(type) {
            document.getElementById('type_transport').value = type;
            const buttons = document.querySelectorAll('.transport-button');
            buttons.forEach(button => {
                button.style.background = '#fff'; // Reset background color
                button.style.color = '#17a2b8'; // Reset text color
            });
            event.currentTarget.style.background = '#17a2b8'; // Highlight selected button
            event.currentTarget.style.color = 'white'; // Change text color for selected button
        }
    </script>
</body>
</html>
