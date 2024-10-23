<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fournisseur;
use Faker\Factory as Faker;

class FournisseurSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            Fournisseur::create([
                'nom' => $faker->company,
                'type' => $faker->randomElement([
                    'Coal',
                    'Oil',
                    'Natural Gas',
                    'Nuclear',
                    'Other', 
                ]), // Assurez-vous que les types sont corrects
                'tarif' => $faker->randomFloat(2, 10, 500), // Tarif entre 10 et 100
            ]);
        }
    }
}
