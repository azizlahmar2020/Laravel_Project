<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

</head>
<body class="custom-background">
@include('frontoffice.navbar')

    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-car"></i> Edit Transport</h2>

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
            <div class="mb-3">
                <label for="type" class="form-label custom-label"><i class="fas fa-bicycle icon"></i> Transport Type</label>
                <input type="text" name="type" class="form-control" id="type" value="{{ old('type', $transport->type) }}" required>
            </div>

            <!-- Distance -->
            <div class="mb-3">
                <label for="distance" class="form-label custom-label"><i class="fas fa-route icon"></i> Distance (km)</label>
                <input type="number" name="distance" class="form-control" id="distance" value="{{ old('distance', $transport->distance) }}" required>
            </div>

            <!-- CO2 Emissions -->
            <div class="mb-3">
                <label for="emissions_CO2" class="form-label custom-label"><i class="fas fa-leaf icon"></i> CO2 Emissions (g)</label>
                <input type="number" name="emissions_CO2" class="form-control" id="emissions_CO2" value="{{ old('emissions_CO2', $transport->emissions_CO2) }}" required>
            </div>

            <!-- Cost -->
            <div class="mb-3">
                <label for="cost" class="form-label custom-label"><i class="fas fa-dollar-sign icon"></i> Cost ($)</label>
                <input type="number" name="cost" class="form-control" id="cost" value="{{ old('cost', $transport->cost) }}" required>
            </div>

            <!-- Duration -->
            <div class="mb-3">
                <label for="duration" class="form-label custom-label"><i class="fas fa-clock icon"></i> Duration (hours)</label>
                <input type="number" name="duration" class="form-control" id="duration" value="{{ old('duration', $transport->duration) }}" required>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Update Transport</button>
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="window.location.href='{{ route('transports.index') }}'">
                <i class="fas fa-times"></i> Cancel
            </button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('frontoffice.footer')

</html>
