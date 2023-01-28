<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Environment;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $environments = ['Development', 'Testing', 'Production'];

        foreach ($environments as $environment) {
            Environment::factory()->create([
                'name' => $environment
            ]);
        }
    }
}
