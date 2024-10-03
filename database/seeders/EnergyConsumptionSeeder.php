<?php

namespace Database\Seeders;

use App\Models\energy_consumption;
use Illuminate\Database\Seeder;

class EnergyConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        energy_consumption::factory()->count(50)->create();
    }
}
