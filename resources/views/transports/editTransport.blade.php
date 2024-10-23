<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer un Transport</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
        .custom-label {
            font-weight: bold;
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Dark green icons */
        }
        .btn-submit {
            background-color: #4CAF50; /* Dark green submit button */
            color: white;
        }
        .transport-button {
            width: 30%;
            margin: 0 10px;
            text-align: center;
            border: 2px solid #4CAF50; /* Dark green border */
            border-radius: 8px;
            background: #fff; /* White background */
            cursor: pointer;
            transition: background 0.3s, color 0.3s;
        }
        .transport-button:hover {
            background: #4CAF50; /* Dark green on hover */
            color: white; /* White text on hover */
        }
    </style>

</head>
<body class="custom-background">
@include('frontoffice.navbar')

    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-car"></i> Editer un Transport</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to edit transport -->
        <form action="{{ route('transports.update', $transport->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Transport Type -->
            <div class="mb-3 text-center">
                <label class="form-label custom-label"><i class="fas fa-shuttle-van icon"></i> Type de Transport</label>
                <div class="d-flex justify-content-center">
                    <div class="transport-button" onclick="selectTransport('Vélo')" id="vélo-button">
                        <i class="fas fa-bicycle fa-2x"></i><br>Vélo
                    </div>
                    <div class="transport-button" onclick="selectTransport('Voiture')" id="voiture-button">
                        <i class="fas fa-car fa-2x"></i><br>Voiture
                    </div>
                    <div class="transport-button" onclick="selectTransport('Moto')" id="moto-button">
                        <i class="fas fa-motorcycle fa-2x"></i><br>Moto
                    </div>
                </div>
                <input type="hidden" id="type_transport" name="type" value="{{ old('type', $transport->type) }}">
            </div>

            <!-- Consumer Field -->
            <div class="mb-3">
                <label for="consommateur" class="form-label custom-label"><i class="fas fa-user icon"></i> Propriétaire</label>
                <select class="form-control" id="consommateur" name="consommateur">
                    <option value="">Choisir un propriétaire</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('consommateur', $transport->consommateur) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('consommateur')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Distance -->
            <div class="mb-3">
                <label for="distance" class="form-label custom-label"><i class="fas fa-route icon"></i> Distance (km)</label>
                <input type="number" name="distance" class="form-control" id="distance" value="{{ old('distance', $transport->distance) }}">
            </div>

            <!-- Duration -->
            <div class="mb-3">
                <label for="duration" class="form-label custom-label"><i class="fas fa-clock icon"></i> Durée (heure)</label>
                <input type="number" name="duration" class="form-control" id="duration" value="{{ old('duration', $transport->duration) }}">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Editer Transport</button>
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="window.location.href='{{ route('transports.index') }}'">
                <i class="fas fa-times"></i> Cancel
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Highlight the selected transport type button
        function selectTransport(type) {
            document.getElementById('type_transport').value = type;
            const buttons = document.querySelectorAll('.transport-button');
            buttons.forEach(button => {
                button.style.background = '#fff'; // Reset background color
                button.style.color = '#4CAF50'; // Reset text color
            });

            // Highlight the selected button
            event.currentTarget.style.background = '#4CAF50'; // Highlight selected button
            event.currentTarget.style.color = 'white'; // Change text color for selected button
        }

        // Set the selected transport type based on the existing value
        document.addEventListener('DOMContentLoaded', () => {
            const transportType = document.getElementById('type_transport').value;
            if (transportType) {
                const button = document.getElementById(transportType.toLowerCase() + '-button');
                if (button) {
                    button.click(); // Simulate a click to highlight the button
                }
            }
        });
    </script>
</body>
</html>
