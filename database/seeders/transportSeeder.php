<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transport;
use Faker\Factory as Faker;

class transportSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // Crée 50 enregistrements fake
            Transport::create([
                'type' => $faker->randomElement(['Voiture', 'Vélo', 'Moto']), // Types de transport
                'distance' => $faker->numberBetween(1, 1000), // Distance en km
                'emissions_CO2' => $faker->randomFloat(2, 0, 500), // Émissions de CO2 en kg
                'cost' => $faker->randomFloat(2, 1, 1000), // Coût en euros
                'duration' => $faker->numberBetween(5, 300), // Durée en minutes
            ]);
        }
    }
}
