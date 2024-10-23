<?php

namespace Database\Factories;

use App\Models\energy_consumption; // Assure-toi d'importer le modèle correctement
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\energy_consumption>
 */
class energy_consumptionFactory extends Factory
{
    protected $model = energy_consumption::class; // Modèle à associer


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1, // Remplacez 10 par le nombre réel d'utilisateurs
            'electricity_consumption' => $this->faker->randomFloat(2, 0, 1000),
            'gas_consumption' => $this->faker->randomFloat(2, 0, 1000),
            'heating_oil_consumption' => $this->faker->randomFloat(2, 0, 1000),
            'solar_energy_generated' => $this->faker->randomFloat(2, 0, 1000),
            'period' => $this->faker->randomElement(['monthly', 'semiannual', 'annual']),
        ];
    }
}
