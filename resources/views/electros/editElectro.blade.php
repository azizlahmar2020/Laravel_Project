<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Electro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

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
@include('frontoffice.navbar')

<div class="container mt-5 custom-container">
    <h2 class="custom-title"><i class="fas fa-plug icon"></i> Edit Electro</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('electros.update', $electro->id_electro) }}" method="POST">
        @csrf
        @method('PUT') <!-- Specifies that this request is an update -->

        <div class="mb-3">
            <label for="type" class="form-label custom-label"><i class="fas fa-plug icon"></i> Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type', $electro->type) }}" required>
        </div>

        <div class="mb-3">
            <label for="puissance" class="form-label custom-label"><i class="fas fa-bolt icon"></i> Puissance</label>
            <input type="number" class="form-control" id="puissance" name="puissance" value="{{ old('puissance', $electro->puissance) }}" required>
        </div>

        <div class="mb-3">
            <label for="duree" class="form-label custom-label"><i class="fas fa-clock icon"></i> Durée</label>
            <input type="number" class="form-control" id="duree" name="duree" value="{{ old('duree', $electro->duree) }}" required>
        </div>

        <div class="mb-3">
            <label for="consomation" class="form-label custom-label"><i class="fas fa-lightbulb icon"></i> Consommation</label>
            <input type="number" class="form-control" id="consomation" name="consomation" value="{{ old('consomation', $electro->consomation) }}" required>
        </div>

        <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Mettre à jour</button>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/isotope/isotope.pkgd.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
@include('frontoffice.footer')
</html>