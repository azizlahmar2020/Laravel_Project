<!DOCTYPE html>
<html lang="en">
<head>
@include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Nouveau Conseil</title>
   <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">     <!-- Libraries Stylesheet -->
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
    <script>
        function calculateCO2() {
            const kWh = parseFloat(document.getElementById('kWhInput').value);
            const conversionFactor = 591; // Fixed conversion factor
            const resultElement = document.getElementById('co2Result');

            if (!isNaN(kWh)) {
                const co2Emissions = (kWh * conversionFactor).toFixed(2);
                resultElement.innerText = `Émissions de CO2: ${co2Emissions} kg`;
            } else {
                resultElement.innerText = 'Veuillez entrer des valeurs valides.';
            }
        }

        function updateEconomies() {
            const kWh = document.getElementById('kWhInput').value;
            document.getElementById('economies').value = kWh; // Update Économie Potentielle field
        }
    </script>
</head>
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-lightbulb"></i> Créer un Nouveau Conseil Économie d'Énergie</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to create a new ConseilE -->
        <form action="{{ route('conseils.store') }}" method="POST">
            @csrf

            <!-- Description du Conseil Field -->
            <div class="mb-3">
                <label for="description" class="form-label custom-label"><i class="fas fa-comment-dots icon"></i> Description du Conseil</label>
                <input type="text" class="form-control" id="description" name="description" >
            </div>

            <!-- Économie Potentielle Field -->
            <div class="mb-3">
    <label for="economies" class="form-label custom-label"><i class="fas fa-chart-line icon"></i> Économie Potentielle (kWh)</label>
    <input type="number" class="form-control" id="economies" name="economies"  step="0.01"  value="{{ old('economies', $conseils->economies ?? '') }}">
</div>


            <!-- Unit Selection Field -->
            <div class="mb-3">
                <label for="unit" class="form-label custom-label"><i class="fas fa-signal icon"></i> Unité</label>
                <select class="form-select" id="unit" name="unit" >
                    <option value="kWh">kWh</option>
                </select>
            </div>

            <!-- Fournisseur Selection Field -->
            <div class="mb-3">
                <label for="fournisseur_id" class="form-label custom-label"><i class="fas fa-building icon"></i> Fournisseur</label>
                <select class="form-select" id="fournisseur_id" name="fournisseur_id" >
                    <option value="">Sélectionnez un fournisseur</option>
                    @foreach($fournisseurs as $fournisseur)
                        <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }}</option>
                    @endforeach
                </select>
            </div>

            <!-- CO2 Calculation Section -->
            <div class="mb-3">
    <label for="kWhInput" class="form-label custom-label"><i class="fas fa-calculator icon"></i> KWh</label>
    <input type="number" class="form-control" id="kWhInput" placeholder="Entrez les kWh"  oninput="updateEconomies()">
</div>
            <button type="button" class="btn btn-submit w-100" onclick="calculateCO2()"><i class="fas fa-calculator"></i> Calculer CO2</button>
            <p id="co2Result" class="mt-3"></p>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Soumettre</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('frontoffice.footer')

</html>
