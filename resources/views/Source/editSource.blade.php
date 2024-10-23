<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Renewable Energy Source</title>
   <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">     <!-- Libraries Stylesheet -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">  <style>
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
 <!-- Navbar Start -->
 @include('frontoffice.navbar')
    <!-- Navbar End -->
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-solar-panel"></i> Edit Renewable Energy Source</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to edit the existing renewable energy source -->
        <form action="{{ route('source.update', $source->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <!-- Source Name Field -->
                    <div class="mb-3">
                        <label for="nom_renouv" class="form-label custom-label"><i class="fas fa-bolt icon"></i> Source Name</label>
                        <input type="text" class="form-control" id="nom_renouv" name="nom_renouv" value="{{ old('nom_renouv', $source->nom_renouv) }}" required>
                    </div>

                    <!-- Description Field -->
                    <div class="mb-3">
                        <label for="desc_renouv" class="form-label custom-label"><i class="fas fa-info-circle icon"></i> Description</label>
                        <textarea class="form-control" id="desc_renouv" name="desc_renouv" rows="3" required>{{ old('desc_renouv', $source->desc_renouv) }}</textarea>
                    </div>

                    <!-- Power Max (kW) Field -->
                    <div class="mb-3">
                        <label for="puissMax_renouv" class="form-label custom-label"><i class="fas fa-tachometer-alt icon"></i> Power Max (kW)</label>
                        <input type="number" class="form-control" id="puissMax_renouv" name="puissMax_renouv" value="{{ old('puissMax_renouv', $source->puissMax_renouv) }}" required>
                    </div>

                    <!-- Commissioning Date Field -->
                    <div class="mb-3">
                        <label for="date_renouv" class="form-label custom-label"><i class="fas fa-calendar-alt icon"></i> Commissioning Date</label>
                        <input type="date" class="form-control" id="date_renouv" name="date_renouv" value="{{ old('date_renouv', $source->date_renouv) }}" required>
                    </div>

                  
                </div>

                <div class="col-md-6">
                      <!-- Type of Energy Field -->
                      <div class="mb-3">
                        <label for="typeE_renouv" class="form-label custom-label"><i class="fas fa-plug icon"></i> Type of Energy</label>
                        <select class="form-control" id="typeE_renouv" name="typeE_renouv" required>
                            <option value="solar" {{ $source->typeE_renouv === 'solar' ? 'selected' : '' }}>Solar</option>
                            <option value="wind" {{ $source->typeE_renouv === 'wind' ? 'selected' : '' }}>Wind</option>
                            <option value="hydro" {{ $source->typeE_renouv === 'hydro' ? 'selected' : '' }}>Hydro</option>
                            <option value="biomass" {{ $source->typeE_renouv === 'biomass' ? 'selected' : '' }}>Biomass</option>
                        </select>
                    </div>
                    <!-- Estimated Production (kWh) Field -->
                    <div class="mb-3">
                        <label for="prodEstime_renouv" class="form-label custom-label"><i class="fas fa-battery-three-quarters icon"></i> Estimated Production (kWh)</label>
                        <input type="number" class="form-control" id="prodEstime_renouv" name="prodEstime_renouv" value="{{ old('prodEstime_renouv', $source->prodEstime_renouv) }}" required>
                    </div>

                    <!-- Installation Cost (€) Field -->
                    <div class="mb-3">
                        <label for="coutInstall_renouv" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i> Installation Cost (€)</label>
                        <input type="number" step="0.01" class="form-control" id="coutInstall_renouv" name="coutInstall_renouv" value="{{ old('coutInstall_renouv', $source->coutInstall_renouv) }}" required>
                    </div>

                    <!-- CO2 Impact (tonnes) Field -->
                    <div class="mb-3">
                        <label for="impactCO2_renouv" class="form-label custom-label"><i class="fas fa-cloud icon"></i> CO2 Impact (tonnes)</label>
                        <input type="number" step="0.01" class="form-control" id="impactCO2_renouv" name="impactCO2_renouv" value="{{ old('impactCO2_renouv', $source->impactCO2_renouv) }}" required>
                    </div>

                  
                    <!-- Proprietor Field -->
                    <div class="mb-3">
                        <label for="proprietaire_renouv" class="form-label custom-label"><i class="fas fa-user icon"></i> Proprietor</label>
                        <input type="text" class="form-control" id="proprietaire_renouv" name="proprio_renouv" value="{{ old('proprio_renouv', $source->proprio_renouv) }}" required>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Update Source</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
