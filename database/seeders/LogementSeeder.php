<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Logement;
use Faker\Factory as Faker;

class LogementSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            Logement::create([
                'address' => $faker->address, // Adresse fictive
                'type' => $faker->randomElement(['Appartement', 'Maison']), // Type de logement
                'superficie' => $faker->numberBetween(50, 300), // Superficie entre 50 et 300 m²
                'nbr_habitant' => $faker->numberBetween(1, 10), // Nombre d'habitants entre 1 et 10
            ]);
        }
    }
}
