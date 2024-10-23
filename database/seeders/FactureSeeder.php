<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facture;
use Faker\Factory as Faker;

class FactureSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // Crée 50 enregistrements fake
            Facture::create([
                'consommateur' => $faker->name, // Nom du consommateur
                'date_facture' => $faker->date(), // Date de la facture
                'periode_facture' => $faker->numberBetween(1, 50000),// Période de la facture
                'consommation_totale' => $faker->randomFloat(2, 50, 500), // Consommation totale entre 50 et 500
                'prix_unitaire' => $faker->randomFloat(2, 0.1, 2), // Prix unitaire entre 0.1 et 2
                'montant_totale' => $faker->randomFloat(2, 10, 1000), // Montant total entre 10 et 1000
                'type_energie' => $faker->randomElement(['Electricity', 'Gas', 'Water']), // Type d'énergie
                'emission_carbone' => $faker->randomFloat(2, 0, 500), // Émission de carbone entre 0 et 500
                'moyen_paiement' => $faker->randomElement(['Credit Card', 'Bank Transfer', 'Cash']), // Moyen de paiement
                'statut' => $faker->randomElement(['Paid', 'Unpaid', 'Pending']), // Statut de la facture
            ]);
        }
    }
}
