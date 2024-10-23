<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Source;
use Faker\Factory as Faker;

class SourceSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // Crée 50 enregistrements fake
            Source::create([
                'nom_renouv' => $faker->word, // Un mot aléatoire
                'desc_renouv' => $faker->sentence, // Une description courte
                'puissMax_renouv' => $faker->numberBetween(100, 10000), // Puissance max en watts
                'date_renouv' => $faker->date, // Date aléatoire
                'typeE_renouv' => $faker->randomElement(['Solaire', 'Éolienne', 'Hydroélectrique', 'Biomasse']), // Type d'énergie
                'prodEstime_renouv' => $faker->numberBetween(1000, 50000), // Production estimée en kWh
                'coutInstall_renouv' => $faker->randomFloat(2, 10000, 500000), // Coût d'installation en euros
                'impactCO2_renouv' => $faker->randomFloat(2, 0, 100), // Impact en CO2 (kg CO2)
                'proprio_renouv' => $faker->name, // Nom du propriétaire
            ]);
        }
    }
}
