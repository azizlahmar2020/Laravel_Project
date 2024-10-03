<!DOCTYPE html>
<html lang="en">
<head>
@include('frontoffice.navbar')

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        .highlight {
            background-color: #C3DCDC; /* Highlight color */
            transition: background-color 0.5s ease; /* Smooth animation */
        }
        .custom-container {
            background-color: #f8f9fa; /* Light background */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .custom-title {
            color: #343a40;
            font-weight: bold;
        }
        .custom-background {
            background-color: #e9ecef;
            min-height: 100vh;
        }
        #transport-table thead {
            background-color: #f1f3f5;
        }
    </style>
</head>
<body class="custom-background">

    <div class="container mt-5">
        <!-- Success Alert -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="custom-container">
            <h2 class="custom-title"><i class="fas fa-bus icon"></i> Transport List</h2>

            <div class="text-end mb-3">
                <a href="{{ route('transports.create') }}" class="btn btn-success mb-3">
                    <i class="fas fa-plus"></i> Add New Transport
                </a>
            </div>

            <!-- Check if there are any transports -->
            @if($transports->isEmpty())
                <p>No transports available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="transport-table">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Distance (km)</th>
                                <th>CO2 Emissions (g)</th>
                                <th>Cost ($)</th>
                                <th>Duration (hours)</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transports as $transport)
                                <tr id="transport-{{ $transport->id }}">
                                    <td>{{ $transport->type }}</td>
                                    <td>{{ $transport->distance }}</td>
                                    <td>{{ $transport->emissions_CO2 }}</td>
                                    <td>{{ $transport->cost }}</td>
                                    <td>{{ $transport->duration }}</td>
                                    <td>
                                        <!-- Edit button -->
                                        <a href="{{ route('transports.editTransport', $transport->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>

                                        <!-- Delete button -->
                                        <form action="{{ route('transports.destroy', $transport->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this transport?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const successAlert = document.getElementById('success-alert');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.classList.remove('show');
                }, 4000);
            }
        });
    </script>
</body>
</html>
