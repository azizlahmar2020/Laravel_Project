<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une source d'Énergie Renouvelable</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            font-size: 30px;
            text-align: center;
            color: #4CAF50; /* Dark green color */
           margin-bottom: 30px;
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
 <!-- Navbar Start -->
 @include('frontoffice.navbar')
    <!-- Navbar End -->
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-solar-panel"></i> Ajouter une source </h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to create a new source_renouv -->
        <form action="{{ route('source.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <!-- Name Field -->
                    <div class="mb-3">
                        <label for="nom_renouv" class="form-label custom-label"><i class="fas fa-bolt icon"></i> Nom de la source</label>
                        <input type="text" class="form-control" id="nom_renouv" name="nom_renouv" >
                    </div>

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="desc_renouv" class="form-label custom-label"><i class="fas fa-info-circle icon"></i> Description</label>
                        <textarea class="form-control" id="desc_renouv" name="desc_renouv" ></textarea>
                    </div>

                    <!-- Puissance Max Field -->
                    <div class="mb-3">
                        <label for="puissMax_renouv" class="form-label custom-label"><i class="fas fa-wind icon"></i>Puissance Max (kW)</label>
                        <input type="number" class="form-control" id="puissMax_renouv" name="puissMax_renouv" >
                    </div>

                    <!-- Date Field -->
                    <div class="mb-3">
                        <label for="date_renouv" class="form-label custom-label"><i class="fas fa-calendar-alt icon"></i>Date de commission</label>
                        <input type="date" class="form-control" id="date_renouv" name="date_renouv" >
                    </div>

                     <!-- Type Field -->
                     <div class="mb-3">
                        <label for="typeE_renouv" class="form-label custom-label"><i class="fas fa-plug icon"></i> Type d'énergie </label>
                        <select class="form-control" id="typeE_renouv" name="typeE_renouv" >
                            <option value="solaire">Solar</option>
                            <option value="éolienne">Wind Turbine</option>
                            <option value="hydroélectrique">Hydroelectric</option>
                            <option value="biomasse">Biomass</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                   
                    <!-- Production Estimée Field -->
                    <div class="mb-3">
                        <label for="prodEstime_renouv" class="form-label custom-label"><i class="fas fa-chart-line icon"></i> Production éstimée (kWh)</label>
                        <input type="number" class="form-control" id="prodEstime_renouv" name="prodEstime_renouv" >
                    </div>

                    <!-- Coût Installation Field -->
                    <div class="mb-3">
                        <label for="coutInstall_renouv" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i> Coût d'installation </label>
                        <input type="number" step="0.01" class="form-control" id="coutInstall_renouv" name="coutInstall_renouv" >
                    </div>

                    <!-- Impact CO2 Field -->
                    <div class="mb-3">
                        <label for="impactCO2_renouv" class="form-label custom-label"><i class="fas fa-leaf icon"></i> Emission de CO2 (tonnes)</label>
                        <input type="number" class="form-control" id="impactCO2_renouv" name="impactCO2_renouv" >
                    </div>

                 
                    <!-- Propriétaire Field (Owner) -->
              <!-- Propriétaire Field (Updated to show dropdown list) -->
<div class="mb-3">
    <label for="proprio_renouv" class="form-label custom-label"><i class="fas fa-user icon"></i>Consommateur</label>
    <select class="form-control" id="proprio_renouv" name="proprio_renouv">
        <option value="">Select Owner</option>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
</div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Ajouter</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
