<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        .header, .footer {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Facture N° {{ $facture->id }}</h2>
    </div>

    <table>
        <tr>
            <th>Consommateur</th>
            <td>{{ $facture->owner->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <th>Date de Facture</th>
            <td>{{ $facture->date_facture }}</td>
        </tr>
        <tr>
            <th>Période de Facture</th>
            <td>{{ $facture->periode_facture }}</td>
        </tr>
        <tr>
            <th>Consommation Totale (kWh)</th>
            <td>{{ $facture->consommation_totale }}</td>
        </tr>
        <tr>
            <th>Prix Unitaire (€)</th>
            <td>{{ $facture->prix_unitaire }}</td>
        </tr>
        <tr>
            <th>Montant Totale (€)</th>
            <td>{{ $facture->montant_totale }}</td>
        </tr>
        <tr>
            <th>Type d'Énergie</th>
            <td>{{ $facture->type_energie }}</td>
        </tr>
        <tr>
            <th>Émission de Carbone (tonnes)</th>
            <td>{{ $facture->emission_carbone }}</td>
        </tr>
        <tr>
            <th>Moyen de Paiement</th>
            <td>{{ $facture->moyen_paiement }}</td>
        </tr>
        <tr>
            <th>Statut</th>
            <td>{{ $facture->statut }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Merci pour votre confiance !</p>
    </div>

</body>
</html>
