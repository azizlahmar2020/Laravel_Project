<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Electroménager</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
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
    </style>
</head>
<body class="custom-background">
    <!-- Navbar inclusion -->

    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-blender"></i> Create a New Electroménager</h2>

        <!-- Error Handling -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form for creating a new Electroménager -->
        <form action="{{ route('Electros.store') }}" method="POST">
            @csrf

            <!-- Type Field -->
            <div class="mb-3">
                <label for="type" class="form-label custom-label"><i class="fas fa-plug icon"></i> Type</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Enter the type of the appliance" >
            </div>

            <!-- Puissance Field -->
            <div class="mb-3">
                <label for="puissance" class="form-label custom-label"><i class="fas fa-bolt icon"></i> Puissance (Watts)</label>
                <input type="number" class="form-control" id="puissance" name="puissance" min="0" placeholder="Enter the power in watts" >
            </div>

            <!-- Duree Field -->
            <div class="mb-3">
                <label for="duree" class="form-label custom-label"><i class="fas fa-clock icon"></i> Durée (Hours)</label>
                <input type="number" class="form-control" id="duree" name="duree" min="0" placeholder="Enter the duration in hours" >
            </div>

            <!-- Consommation Field -->
            <div class="mb-3">
                <label for="consomation" class="form-label custom-label"><i class="fas fa-battery-half icon"></i> Consommation (kWh)</label>
                <input type="number" class="form-control" id="consomation" name="consomation"  placeholder="Enter the consumption in kWh" >
            </div>



            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Submit</button>
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="window.location.href='{{ route('electros.indexElectro') }}'">
    <i class="fas fa-times"></i> Cancel
</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
