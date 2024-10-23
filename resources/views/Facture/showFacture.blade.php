<!DOCTYPE html>
<html lang="en">
<head>
    @include('frontoffice.navbar')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la facture</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .custom-background {
            background-color: #f0f8f0;
        }
    </style>
</head>
<body class="custom-background">

<div class="container mt-5">
    <h2 class="mb-4">Détails de la facture</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Consommateur : {{ $facture->owner->name ?? 'N/A' }}</h5>
            <p>Date de facturation : {{ $facture->date_facture }}</p>
            <p>Période de facturation : {{ $facture->periode_facture }}</p>
            <p>Consommation CO2 Totale : {{ $facture->consommation_totale }} kWh</p>
            <p>Prix unitaire : {{ $facture->prix_unitaire }} €</p>
            <p>Prix total : {{ $facture->montant_totale }} €</p>
            <p>Type d'énergie : {{ $facture->type_energie }}</p>
            <p>Emission de CO2 : {{ $facture->emission_carbone }} tonnes</p>
            <p>Type de paiement : {{ $facture->moyen_paiement }}</p>
            <p>Statut : {{ $facture->statut }}</p>

            <!-- Add Renewable Source Button -->
            <div class="text-end mb-3">
                <button id="preview-facture" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#renewableSourceDropdown" aria-expanded="false" aria-controls="renewableSourceDropdown">
                    Ajouter une source renouvelable
                </button>
            </div>

            <!-- Dropdown List for Renewable Source -->
            <div class="collapse" id="renewableSourceDropdown">
                <div class="card card-body">
                    <form action="{{ route('facture.addSource', $facture->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir ajouter cette source renouvelable à la facture ?')">
                        @csrf
                        <div class="mb-3">
                            <label for="source" class="form-label">Sélectionnez une source renouvelable :</label>
                            <select class="form-select" name="source_id" id="source" required>
                                @foreach($sources as $source)
                                    <option value="{{ $source->id }}">{{ $source->nom_renouv }} - Impact CO2: {{ $source->impactCO2_renouv }} tonnes, Coût: {{ $source->coutInstall_renouv }} €</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" id="calculate-preview" class="btn btn-info">Aperçu des changements</button>
                        <button type="submit" class="btn btn-success">Ajouter</button>
                    </form>
                </div>
            </div>

            <div id="updated-facture" class="mt-4" style="display: none;">
                <h5>Prévisualisation de la Facture Mise à Jour</h5>
                <p id="updated-montant">Montant Totale : </p>
                <p id="updated-emission">Émission de Carbone : </p>
                <p>Voulez-vous enregistrer ces modifications ?</p>
                <button id="save-facture" class="btn btn-success">Enregistrer</button>
            </div>

            <div class="text-end mt-3">
                <a href="{{ route('facture.index') }}" class="btn btn-secondary">Retour à la liste des factures</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('calculate-preview').addEventListener('click', function() {
        var sourceId = document.getElementById('source').value;
        var factureId = {{ $facture->id }};
        
        // Appel Ajax pour obtenir les nouveaux montants
        fetch(`/facture/${factureId}/calculate-source`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                source_id: sourceId
            })
        })
        .then(response => response.json())
        .then(data => {
            // Vérifiez que les données sont valides avant de les utiliser
            var newMontant = parseFloat(data.new_montant);
            var newEmission = parseFloat(data.new_emission);

            // Afficher la facture mise à jour
            document.getElementById('updated-facture').style.display = 'block';
            document.getElementById('updated-montant').innerHTML = `Montant Totale : ${newMontant.toFixed(2)} €`;
            document.getElementById('updated-emission').innerHTML = `Émission de Carbone : ${newEmission.toFixed(2)} tonnes`;
        })
        .catch(error => console.error('Erreur:', error));
    });

    // Gérer la sauvegarde de la facture
    document.getElementById('save-facture').addEventListener('click', function() {
        var sourceId = document.getElementById('source').value;
        var factureId = {{ $facture->id }};
        
        fetch(`/facture/${factureId}/add-source`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                source_id: sourceId
            })
        })
        .then(response => window.location.reload())
        .catch(error => console.error('Erreur:', error));
    });
</script>
@include('frontoffice.footer')
</body>
</html>
