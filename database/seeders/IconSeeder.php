<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Icon;

class IconSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $icons = [
            ['name' => 'Angular', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg'],
            ['name' => 'React', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'],
            ['name' => 'Vue.js', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg'],
            ['name' => 'Next.js', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nextjs/nextjs-original-wordmark.svg'],
            ['name' => 'Nuxt.js', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nuxtjs/nuxtjs-original.svg'],
            ['name' => '11ty', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/eleventy/eleventy-original.svg'],
            ['name' => 'Laravel', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg'],
            ['name' => 'Symfony', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/symfony/symfony-original.svg'],
            ['name' => 'Node.js', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg'],
            ['name' => 'PHP', 'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg']
        ];

        foreach ($icons as $icon) {
            Icon::factory()->create([
                'name' => $icon['name'],
                'url' => $icon['url']
            ]);
        }
    }
}
