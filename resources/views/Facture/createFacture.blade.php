<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Energy Bill</title>
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
            background-color: #f0f8f0; /* Light blue background */
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
            color: #4CAF50; /* Blue color */
            margin-bottom: 30px;
        }
        .custom-label {
            font-weight: bold;
        }
        .icon {
            margin-right: 8px;
            color: #4CAF50; /* Blue icons */
        }
        .btn-submit {
            background-color: #4CAF50; /* Blue submit button */
            color: white;
        }
    </style>
</head>
 <!-- Navbar Start -->
 @include('frontoffice.navbar')
    <!-- Navbar End -->
<body class="custom-background">
    <div class="container mt-5 custom-container">
        <h2 class="custom-title"><i class="fas fa-file-invoice"></i>Add Energy Bill</h2>

       

        <!-- Form to create a new facture -->
        <form action="{{ route('facture.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <!-- Consommateur Field -->
                    <div class="mb-3">
                        <label for="consommateur" class="form-label custom-label"><i class="fas fa-user icon"></i> Consumer</label>
                        <input type="text" class="form-control" id="consommateur" name="consommateur">
                        @error('consommateur')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Date Facture Field -->
                    <div class="mb-3">
                        <label for="date_facture" class="form-label custom-label"><i class="fas fa-calendar-alt icon"></i> Bill date</label>
                        <input type="date" class="form-control" id="date_facture" name="date_facture">
                        @error('date_facture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Période Facture Field -->
                    <div class="mb-3">
                        <label for="periode_facture" class="form-label custom-label"><i class="fas fa-clock icon"></i> Billing Period</label>
                        <input type="number" class="form-control" id="periode_facture" name="periode_facture">
                        @error('periode_facture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Consommation Totale Field -->
                    <div class="mb-3">
                        <label for="consommation_totale" class="form-label custom-label"><i class="fas fa-tachometer-alt icon"></i>Total Consumption (kWh)</label>
                        <input type="number" class="form-control" id="consommation_totale" name="consommation_totale">
                        @error('consommation_totale')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prix Unitaire Field -->
                    <div class="mb-3">
                        <label for="prix_unitaire" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i>Unit Price (dt/ kWh)</label>
                        <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire">
                        @error('prix_unitaire')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Montant Total Field -->
                    <div class="mb-3">
                        <label for="montant_totale" class="form-label custom-label"><i class="fas fa-money-bill-wave icon"></i>Total Price</label>
                        <input type="number" class="form-control" id="montant_totale" name="montant_totale">
                        @error('montant_totale')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type d'Énergie Field -->
                    <div class="mb-3">
                        <label for="type_energie" class="form-label custom-label"><i class="fas fa-plug icon"></i>Energy Type</label>
                        <select class="form-control" id="type_energie" name="type_energie">
                            <option value="electricity">Electricity</option>
                            <option value="gas">Gas</option>
                            <option value="water">Water</option>
                            <option value="heating">Heating</option>

                        </select>
                        @error('type_energie')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Emission Carbone Field -->
                    <div class="mb-3">
                        <label for="emission_carbone" class="form-label custom-label"><i class="fas fa-leaf icon"></i>Carbon Emission (tonnes)</label>
                        <input type="number" step="0.01" class="form-control" id="emission_carbone" name="emission_carbone">
                        @error('emission_carbone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Moyen de Paiement Field -->
                    <div class="mb-3">
                        <label for="moyen_paiement" class="form-label custom-label"><i class="fas fa-credit-card icon"></i>Payment Method</label>
                        <select class="form-control" id="moyen_paiement" name="moyen_paiement">
                            <option value="Credit Card">Credit Card</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                        </select>
                        @error('moyen_paiement')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut Field -->
                    <div class="mb-3">
                        <label for="statut" class="form-label custom-label"><i class="fas fa-info-circle icon"></i> Statut</label>
                        <select class="form-control" id="statut" name="statut">
                            <option value="payée">Paid</option>
                            <option value="en_attente">Pending</option>
                        </select>
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Submit</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
@include('frontoffice.footer')

</html>
