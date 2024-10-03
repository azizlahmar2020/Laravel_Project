<!DOCTYPE html>
<html lang="en">
<head>
@include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Logement</title>
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
    </style>

</head>
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-home"></i> Edit Logement</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form to edit the existing logement -->
        <form action="{{ route('Logement.update', $logement->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Address Field -->
            <div class="mb-3">
                <label for="address" class="form-label custom-label"><i class="fas fa-map-marker-alt icon"></i> Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $logement->address) }}">
            </div>

            <!-- Type Field -->
            <div class="mb-3">
                <label for="type" class="form-label custom-label"><i class="fas fa-building icon"></i> Type</label>
                <select class="form-control" id="type" name="type" >
                    <option value="maison" {{ $logement->type === 'maison' ? 'selected' : '' }}>Maison</option>
                    <option value="appartement" {{ $logement->type === 'appartement' ? 'selected' : '' }}>Appartement</option>
                </select>
            </div>

            <!-- Superficie Field -->
            <div class="mb-3">
                <label for="superficie" class="form-label custom-label"><i class="fas fa-ruler-combined icon"></i> Superficie</label>
                <input type="text" class="form-control" id="superficie" name="superficie" value="{{ old('superficie', $logement->superficie) }}" >
            </div>

            <!-- Number of Inhabitants Field -->
            <div class="mb-3">
                <label for="nbr_habitant" class="form-label custom-label"><i class="fas fa-users icon"></i> Number of Inhabitants</label>
                <input type="number" class="form-control" id="nbr_habitant" name="nbr_habitant" value="{{ old('nbr_habitant', $logement->nbr_habitant) }}" >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Update</button>
            <button type="button" class="btn btn-danger w-100 mt-3" onclick="window.location.href='{{ route('Logement.indexLogement') }}'">
    <i class="fas fa-times"></i> Cancel
</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
