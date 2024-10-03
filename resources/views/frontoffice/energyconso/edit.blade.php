<!DOCTYPE html>
<html lang="en">

<head>
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

    @include('frontoffice.navbar')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white text-center">
                        <h2>
                            <i class="fas fa-bolt"></i> Create a New Energy Consumption Record
                        </h2>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('energyconso.update', $energyConsumption) }}">
                            @csrf
                            @method('PUT')

                            <!-- Electricity Consumption -->
                            <div class="form-group mb-3">
                                <label for="electricity_consumption" class="form-label">
                                    <i class="fas fa-plug"></i> Electricity Consumption (kWh)
                                </label>
                                <input type="number" name="electricity_consumption" id="electricity_consumption"
                                    step="0.01" class="form-control"
                                    value="{{ $energyConsumption->electricity_consumption }}">
                            </div>

                            <!-- Gas Consumption -->
                            <div class="form-group mb-3">
                                <label for="gas_consumption" class="form-label">
                                    <i class="fas fa-gas-pump"></i> Gas Consumption (m³)
                                </label>
                                <input type="number" name="gas_consumption" id="gas_consumption" step="0.01"
                                    class="form-control" value="{{ $energyConsumption->gas_consumption }}">
                            </div>

                            <!-- Heating Oil Consumption -->
                            <div class="form-group mb-3">
                                <label for="heating_oil_consumption" class="form-label">
                                    <i class="fas fa-oil-can"></i> Heating Oil Consumption (litres)
                                </label>
                                <input type="number" name="heating_oil_consumption" id="heating_oil_consumption"
                                    step="0.01" class="form-control"
                                    value="{{ $energyConsumption->heating_oil_consumption }}">
                            </div>

                            <!-- Solar Energy Generated -->
                            <div class="form-group mb-3">
                                <label for="solar_energy_generated" class="form-label">
                                    <i class="fas fa-sun"></i> Solar Energy Generated (kWh)
                                </label>
                                <input type="number" name="solar_energy_generated" id="solar_energy_generated"
                                    step="0.01" class="form-control"
                                    value="{{ $energyConsumption->solar_energy_generated }}">
                            </div>

                            <!-- Period (Consumption Date) -->
                            <div class="form-group mb-3">
                                <label for="period" class="form-label">
                                    <i class="fas fa-calendar-day"></i> Period
                                </label>
                                <select name="period" class="form-control" required>
                                    <option value="monthly"
                                        {{ $energyConsumption->period == 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="semiannual"
                                        {{ $energyConsumption->period == 'semiannual' ? 'selected' : '' }}>Semiannual
                                    </option>
                                    <option value="annual"
                                        {{ $energyConsumption->period == 'annual' ? 'selected' : '' }}>Annual</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-paper-plane"></i> Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>










</body>

</html>
