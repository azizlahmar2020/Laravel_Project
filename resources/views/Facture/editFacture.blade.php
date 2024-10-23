
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editer la facture</title>
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
        <h2 class="custom-title"><i class="fas fa-file-invoice"></i> Editer la facture</h2>
        <!-- Form to edit the existing facture -->
        <form action="{{ route('facture.update', $facture->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <!-- Consommateur Field -->
                    <div class="mb-3">
        <label for="consommateur" class="form-label custom-label">
            <i class="fas fa-user icon"></i> Consommateur
        </label>
        <select class="form-control" id="consommateur" name="consommateur">
            <option value="">Choisir le consommateur</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $facture->consommateur ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
        </select>
        @error('consommateur')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

                    <!-- Date Facture Field -->
                    <div class="mb-3">
                        <label for="date_facture" class="form-label custom-label"><i class="fas fa-calendar-alt icon"></i>Date de la facturation</label>
                        <input type="date" class="form-control" id="date_facture" name="date_facture" value="{{ old('date_facture', $facture->date_facture) }}">
                        @error('date_facture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Periode Facture Field -->
                    <div class="mb-3">
                        <label for="periode_facture" class="form-label custom-label"><i class="fas fa-calendar-week icon"></i>Période de facturation</label>
                        <input type="text" class="form-control" id="periode_facture" name="periode_facture" value="{{ old('periode_facture', $facture->periode_facture) }}">
                        @error('periode_facture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Consommation Totale Field -->
                    <div class="mb-3">
                        <label for="consommation_totale" class="form-label custom-label"><i class="fas fa-tachometer-alt icon"></i> Consommation totale (kWh)</label>
                        <input type="number" class="form-control" id="consommation_totale" name="consommation_totale" value="{{ old('consommation_totale', $facture->consommation_totale) }}">
                        @error('consommation_totale')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Prix Unitaire Field -->
                    <div class="mb-3">
                        <label for="prix_unitaire" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i>Prix unitaire (dt/ kWh)</label>
                        <input type="number" step="0.01" class="form-control" id="prix_unitaire" name="prix_unitaire" value="{{ old('prix_unitaire', $facture->prix_unitaire) }}">
                        @error('prix_unitaire')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Montant Totale Field -->
                    <div class="mb-3">
                        <label for="montant_totale" class="form-label custom-label"><i class="fas fa-euro-sign icon"></i>Prix total</label>
                        <input type="number" step="0.01" class="form-control" id="montant_totale" name="montant_totale" value="{{ old('montant_totale', $facture->montant_totale) }}">
                        @error('montant_totale')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Type d'Energie Field -->
                    <div class="mb-3">
                        <label for="type_energie" class="form-label custom-label"><i class="fas fa-plug icon"></i>Type d'énergie</label>
                        <select class="form-control" id="type_energie" name="type_energie">


                            <option value="electricity" {{ $facture->type_energie === 'electricity' ? 'selected' : '' }}>Electricity</option>
                            <option value="gas" {{ $facture->type_energie === 'gas' ? 'selected' : '' }}>Gas</option>
                            <option value="water" {{ $facture->type_energie === 'water' ? 'selected' : '' }}>Water</option>
                            <option value="heating" {{ $facture->type_energie === 'heating' ? 'selected' : '' }}>Heating</option>
                        </select>
                        @error('type_energie')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Emission Carbone Field -->
                    <div class="mb-3">
                        <label for="emission_carbone" class="form-label custom-label"><i class="fas fa-tree icon"></i>Emission de CO2</label>
                        <input type="number" step="0.01" class="form-control" id="emission_carbone" name="emission_carbone" value="{{ old('emission_carbone', $facture->emission_carbone) }}">
                        @error('emission_carbone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Moyen Paiement Field -->
                    <div class="mb-3">
                        <label for="moyen_paiement" class="form-label custom-label"><i class="fas fa-credit-card icon"></i>Méthode de paiement</label>
                        <select class="form-control" id="moyen_paiement" name="moyen_paiement">
                            <option value="Credit Card" {{ $facture->moyen_paiement === 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                            <option value="Bank Transfer" {{ $facture->moyen_paiement === 'virement' ? 'selected' : '' }}>Bank Transfer</option>
                            <option value="Cash" {{ $facture->moyen_paiement === 'Cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                              @error('moyen_paiement')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Statut Field -->
                    <div class="mb-3">
                        <label for="statut" class="form-label custom-label"><i class="fas fa-flag icon"></i> Statut</label>
                        <select class="form-control" id="statut" name="statut">
                        <option value="Paid" {{ $facture->statut === 'Paid' ? 'selected' : '' }}>Paid</option>
                        <option value="Pending" {{ $facture->statut === 'Pending' ? 'selected' : '' }}>Pending</option>
                        </select>
                        @error('statut')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-submit w-100"><i class="fas fa-paper-plane"></i> Editer la facture</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
