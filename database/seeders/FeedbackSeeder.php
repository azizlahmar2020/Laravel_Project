<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Feedback;
use Faker\Factory as Faker;

class FeedbackSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) { // Crée 50 enregistrements fake
            Feedback::create([
                'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true), // Commentaire aléatoire
                'email' => $faker->unique()->safeEmail, // Adresse email unique
                'date' => $faker->dateTimeBetween('-1 years', 'now'), // Date aléatoire dans la dernière année
                'rating' => $faker->numberBetween(1, 5), // Note entre 1 et 5
            ]);
        }
    }
}
