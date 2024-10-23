<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renewable Energy Sources</title>
   <!-- Bootstrap CSS -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">     <!-- Libraries Stylesheet -->
<link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
 <!-- Navbar Start -->
 @include('frontoffice.navbar')
    <!-- Navbar End -->
<body>
    <div class="container mt-5">
        @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
        @endif

        <h2 class="text-center mb-4">List of Renewable Energy Sources</h2>

        <a href="{{ route('source.create') }}" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Add New Source</a>

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Source Name</th>
                    <th>Description</th>
                    <th>Power Max (kW)</th>
                    <th>Commissioning Date</th>
                    <th>Type of Energy</th>
                    <th>Estimated Production (kWh)</th>
                    <th>Installation Cost (€)</th>
                    <th>CO2 Impact (tonnes)</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sources as $source)
                <tr>
                    <td>{{ $source->nom_renouv }}</td>
                    <td>{{ $source->desc_renouv }}</td>
                    <td>{{ $source->puissMax_renouv }}</td>
                    <td>{{ $source->date_renouv }}</td>
                    <td>{{ $source->typeE_renouv }}</td>
                    <td>{{ $source->prodEstime_renouv }}</td>
                    <td>{{ $source->coutInstall_renouv }}</td>
                    <td>{{ $source->impactCO2_renouv }}</td>
                    <td>{{ $source->proprio_renouv }}</td>
                    <td>
                        <a href="{{ route('source.edit', $source->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('source.destroy', $source->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<div class="d-flex justify-content-center mt-4">
{{ $sources->links() }}
</div>
@include('frontoffice.footer')
</html>
