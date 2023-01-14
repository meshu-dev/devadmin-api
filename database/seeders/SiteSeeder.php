<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Environment;
use App\Models\Icon;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Environment::factory()
            ->count(5)
            ->has(Site::factory()->count(10), 'sites')
            ->create();

        Icon::factory()->count(10)->create();
    }
}
