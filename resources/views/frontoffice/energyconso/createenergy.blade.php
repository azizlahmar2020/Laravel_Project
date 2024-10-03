<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontoffice.navbar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <title>Document</title>
</head>

<body>



    <div class="container bg-white p-5 rounded shadow-lg">
        <h2 class="text-center text-success mb-4">
            <i class="fas fa-bolt"></i> Create a New Energy Consumption Record
        </h2>


        <form method="POST" action="{{ route('energyconso.store') }}">
            @csrf

            <!-- Electricity Consumption -->
            <div class="mb-3">
                <label for="electricity_consumption" class="form-label">
                    <i class="fas fa-plug"></i> Electricity Consumption (kWh)
                </label>
                <input type="text" name="electricity_consumption" id="electricity_consumption" class="form-control"
                    placeholder="Enter electricity consumption">
                @error('electricity_consumption')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gas Consumption -->
            <div class="mb-3">
                <label for="gas_consumption" class="form-label">
                    <i class="fas fa-gas-pump"></i> Gas Consumption (m³)
                </label>
                <input type="number" name="gas_consumption" id="gas_consumption" step="0.01" class="form-control"
                    placeholder="Enter gas consumption" min="0">
                @error('gas_consumption')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Heating Oil Consumption -->
            <div class="mb-3">
                <label for="heating_oil_consumption" class="form-label">
                    <i class="fas fa-oil-can"></i> Heating Oil Consumption (litres)
                </label>
                <input type="number" name="heating_oil_consumption" id="heating_oil_consumption" step="0.01"
                    class="form-control" placeholder="Enter heating oil consumption" min="0">
                @error('heating_oil_consumption')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Solar Energy Generated -->
            <div class="mb-3">
                <label for="solar_energy_generated" class="form-label">
                    <i class="fas fa-sun"></i> Solar Energy Generated (kWh)
                </label>
                <input type="number" name="solar_energy_generated" id="solar_energy_generated" step="0.01"
                    class="form-control" placeholder="Enter solar energy generated" min="0">
                @error('solar_energy_generated')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Period -->
            <div class="mb-3">
                <label for="period" class="form-label">
                    <i class="fas fa-calendar-day"></i> Period
                </label>
                <select name="period" id="period" class="form-select">
                    <option value="monthly">Monthly</option>
                    <option value="semiannual">Semiannual</option>
                    <option value="annual">Annual</option>
                </select>
                @error('period')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-paper-plane"></i> Add
                </button>
            </div>
        </form>

    </div>













</body>

</html>
