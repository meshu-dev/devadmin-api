<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Icon;

class IconTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/icons';

    protected $iconStructure = [
        'id',
        'name',
        'url'
    ];

    public function test_getting_icon_by_id()
    {
        $this->setupAuth();

        $icon = $this->addIcon();

        $this->json('GET', "{$this->url}/{$icon->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->iconStructure
            ]);
    }

    public function test_stop_getting_icon_by_id_with_no_token()
    {
        $icon = $this->addIcon();

        $this->testUnauthorised('GET', "{$this->url}/{$icon->id}");
    }

    public function test_getting_empty_icon_by_invalid_id()
    {
        $this->setupAuth();

        $id = $this->getInvalidId();

        $this->json('GET', "{$this->url}/$id")
             ->assertStatus(422);
    }

    public function test_getting_list_of_icons()
    {
        $this->setupAuth();

        $this->addIcons();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->iconStructure
                ]
            ]);
    }

    public function test_stop_getting_list_of_icons_with_no_token()
    {
        $this->addIcons();

        $this->testUnauthorised('GET', $this->url);
    }

    public function test_getting_empty_list_of_icons()
    {
        $this->setupAuth();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJson([
                'data' => []
            ]);
    }

    protected function addIcons()
    {
        Icon::create([
            'name' => 'Angular',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg'
        ]);
        Icon::create([
            'name' => 'React',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'
        ]);
        Icon::create([
            'name' => 'Vue.js',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg'
        ]);
        Icon::create([
            'name' => 'PHP',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg'
        ]);
        Icon::create([
            'name' => 'Laravel',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-plain.svg'
        ]);
    }
}
