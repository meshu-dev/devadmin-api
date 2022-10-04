<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Environment;
use App\Models\Site;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/sites';
    protected $siteStructure = [
        'id',
        'environment' => [
            'id',
            'name'
        ],
        'name',
        'url'
    ];

    private function addEnvironment()
    {
        $environment = Environment::create(['name' => 'Production']);
        return $environment;
    }

    public function test_get_site_by_id_success()
    {
        $environment = $this->addEnvironment();
        $site = Site::create([
            'environment_id' => $environment->id,
            'name' => 'Google',
            'url' => 'http://www.google.com'
        ]);

        $this->json('GET', "{$this->url}/{$site->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->siteStructure
            ]);
    }

    public function test_get_list_of_sites_success()
    {
        $environment = $this->addEnvironment();
        Site::create([
            'environment_id' => $environment->id,
            'name' => 'Google',
            'url' => 'http://www.google.com'
        ]);
        Site::create([
            'environment_id' => $environment->id,
            'name' => 'Bing',
            'url' => 'http://www.bing.com'
        ]);

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->siteStructure
                ]
            ]);
    }
    
    /*
    public function test_add_environment_success()
    {
        $environment = $this->addEnvironment();
        $params = [
            'name' => 'Github',
            'url' => 'https://github.com'
        ];

        $this->json('POST', $this->url, $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id',
                    'environment' => [
                        'id',
                        'name'
                    ],
                    'name',
                    'url'
                ]
            ]);
    }

    /*
    public function test_edit_environment_success()
    {
        $environment = Environment::create(['name' => 'Test']);

        $id = $environment->id;
        $params = [
            'name' => 'Staging'
        ];

        $this->json('PUT', "{$this->url}/{$id}", $params)
            ->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id' => $id,
                    'name' => 'Staging'
                ]
            ]);
    }

    public function test_delete_environment_success()
    {
        $environment = Environment::create(['name' => 'Live']);
        $id = $environment->id;

        $this->json('DELETE', "{$this->url}/{$id}")
             ->assertStatus(204);
    } */
}
