<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(FournisseurSeeder::class);
        $this->call(ConseilESeeder::class);
        $this->call(LogementSeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(transportSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(FactureSeeder::class);
        $this->call(ElectroSeeder::class);
        $this->call(EnergyConsumptionSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
