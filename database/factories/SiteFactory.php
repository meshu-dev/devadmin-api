<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Site;
use App\Models\Environment;
use App\Models\Icon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    protected $model = Site::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'environment_id' => Environment::factory(),
            'icon_id' => Icon::inRandomOrder()->first()->id,
            'name' => fake()->company(),
            'url' => fake()->url()
        ];
    }
}
