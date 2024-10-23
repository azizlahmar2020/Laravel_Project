<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConseilE; // Assurez-vous que le modèle est correctement importé
use Faker\Factory as Faker;

class ConseilESeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            ConseilE::create([
                'description' => $faker->text(100),
                'economies' => $faker->randomFloat(2, 100, 1000), // Valeur aléatoire entre 100 et 1000
                'fournisseur_id' => rand(1, 10), // Assurez-vous que ce ID existe dans votre table Fournisseurs
            ]);
        }
    }
}
