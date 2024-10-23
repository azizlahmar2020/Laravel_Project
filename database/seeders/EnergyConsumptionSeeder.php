<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\energy_consumption; // Assurez-vous d'utiliser le bon nom de modèle
use Faker\Factory as Faker;

class EnergyConsumptionSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            energy_consumption::create([
                'user_id' => $faker->numberBetween(1, 50), // Assurez-vous que les IDs d'utilisateur existent
                'electricity_consumption' => $faker->randomFloat(2, 50, 500), // Consommation d'électricité entre 50 et 500 kWh
                'gas_consumption' => $faker->randomFloat(2, 10, 100), // Consommation de gaz entre 10 et 100 m³
                'heating_oil_consumption' => $faker->randomFloat(2, 0, 200), // Consommation de fioul entre 0 et 200 litres
                'solar_energy_generated' => $faker->randomFloat(2, 0, 100), // Énergie solaire générée entre 0 et 100 kWh
                'period' => $faker->randomElement(['monthly', 'semiannual', 'annual']), // Périodicité de la consommation
            ]);
        }
    }
}
