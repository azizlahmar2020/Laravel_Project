<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Electro;
use App\Models\Logement; // Assure-toi d'importer le modèle Logement
use Faker\Factory as Faker;

class ElectroSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // On suppose que tu as déjà des enregistrements dans la table logements
        $logements = Logement::all();

        foreach (range(1, 100) as $index) { // Crée 100 enregistrements fake
            Electro::create([
                'type' => $faker->randomElement(['Réfrigérateur', 'Lave-linge', 'Télévision', 'Ordinateur']), // Type d'électroménager
                'puissance' => $faker->numberBetween(50, 3000), // Puissance entre 50 et 3000 Watts
                'duree' => $faker->numberBetween(1, 24), // Durée d'utilisation en heures
                'consomation' => $faker->randomFloat(2, 0, 10), // Consommation entre 0 et 10 kWh
                'logement_id' => $faker->randomElement($logements->pluck('id')->toArray()), // ID du logement associé
            ]);
        }
    }
}
