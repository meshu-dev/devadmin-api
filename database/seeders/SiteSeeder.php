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
        $icons = Icon::factory()->count(10)->create();
        $sites = Site::factory()->hasIcon($icons->random())->count(4);

        Environment::factory()
            ->count(5)
            ->has($sites, 'sites')
            ->create();
    }
}
