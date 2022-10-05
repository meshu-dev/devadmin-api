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
    
    public function test_add_site_success()
    {
        $environment = $this->addEnvironment();
        
        $name = 'Github';
        $url = 'https://github.com';

        $params = [
            'environment_id' => $environment->id,
            'name' => $name,
            'url' => $url
        ];

        $this->json('POST', $this->url, $params)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => $this->siteStructure
            ])
            ->assertJson([
                'data' => [
                    'name' => $name,
                    'url' => $url
                ]
            ]);
    }

    public function test_edit_site_success()
    {
        $testEnv = Environment::create(['name' => 'Test']);
        $localEnv = Environment::create(['name' => 'Local']);

        $site = Site::create([
            'environment_id' => $testEnv->id,
            'name' => 'Stack Overflow',
            'url' => 'https://stackoverflow.com'
        ]);

        $envId = $localEnv->id;
        $name = 'Bug Crowd';
        $url = 'https://www.bugcrowd.com';

        $params = [
            'environment_id' => $envId,
            'name' => $name,
            'url' => $url
        ];

        $this->json('PUT', "{$this->url}/{$site->id}", $params)
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->siteStructure
            ])
            ->assertJson([
                'data' => [
                    'environment' => [
                        'id' => $envId
                    ],
                    'name' => $name,
                    'url' => $url
                ]
            ]);
    }

    public function test_delete_site_success()
    {
        $environment = $this->addEnvironment();

        $site = Site::create([
            'environment_id' => $environment->id,
            'name' => 'Laravel',
            'url' => 'https://laravel.com'
        ]);

        $this->json('DELETE', "{$this->url}/{$site->id}")
             ->assertStatus(204);
    } 
}
