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

    public function test_getting_site_by_id()
    {
        $this->setupAuth();

        $site = $this->addSite();

        $this->json('GET', "{$this->url}/{$site->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->siteStructure
            ]);
    }

    public function test_stop_getting_site_by_id_with_no_token()
    {
        $site = $this->addSite();

        $this->testUnauthorised('GET', "{$this->url}/{$site->id}");
    }

    public function test_getting_empty_site_by_invalid_id()
    {
        $this->setupAuth();

        $id = $this->getInvalidId();

        $this->json('GET', "{$this->url}/$id")
             ->assertStatus(422);
    }

    public function test_getting_list_of_sites()
    {
        $this->setupAuth();

        $this->addSites();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->siteStructure
                ]
            ]);
    }

    public function test_stop_getting_list_of_sites_with_no_token()
    {
        $this->addSites();

        $this->testUnauthorised('GET', $this->url);
    }

    public function test_getting_empty_list_of_sites()
    {
        $this->setupAuth();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJson([
                'data' => []
            ]);
    }

    public function test_adding_site()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();
        $icon = $this->addIcon();

        $name = 'Github';
        $url = 'https://github.com';

        $params = [
            'environment_id' => $environment->id,
            'icon_id' => $icon->id,
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

    public function test_stop_adding_site_with_no_token()
    {
        $environment = $this->addEnvironment();
        $icon = $this->addIcon();

        $name = 'Github';
        $url = 'https://github.com';

        $params = [
            'environment_id' => $environment->id,
            'icon_id' => $icon->id,
            'name' => $name,
            'url' => $url
        ];

        $this->testUnauthorised('POST', $this->url, $params);
    }

    public function test_editing_site()
    {
        $this->setupAuth();

        $site = $this->addSite();

        $env = Environment::create(['name' => 'Test']);
        $icon = $this->addIcon([
            'name' => 'React',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'
        ]);

        $envId = $env->id;
        $iconId = $icon->id;
        $name = 'Bug Crowd';
        $url = 'https://www.bugcrowd.com';

        $params = [
            'environment_id' => $envId,
            'icon_id' => $iconId,
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

    public function test_stop_editing_site_with_no_token()
    {
        $site = $this->addSite();
        $env = Environment::create(['name' => 'Test']);
        $icon = $this->addIcon([
            'name' => 'React',
            'url' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg'
        ]);

        $envId = $env->id;
        $iconId = $icon->id;
        $name = 'Bug Crowd';
        $url = 'https://www.bugcrowd.com';

        $params = [
            'environment_id' => $envId,
            'icon_id' => $iconId,
            'name' => $name,
            'url' => $url
        ];

        $this->testUnauthorised('PUT', "{$this->url}/{$site->id}", $params);
    }

    public function test_deleting_site()
    {
        $this->setupAuth();

        $site = $this->addSite();

        $this->json('DELETE', "{$this->url}/{$site->id}")
             ->assertStatus(204);
    }

    public function test_stop_deleting_site_with_no_token()
    {
        $site = $this->addSite();

        $this->testUnauthorised('DELETE', "{$this->url}/{$site->id}");
    }

    public function test_stop_deleting_site_with_invalid_id()
    {
        $this->setupAuth();

        $id = $this->getInvalidId();

        $this->json('DELETE', "{$this->url}/$id")
             ->assertStatus(422);
    }

    protected function addSite()
    {
        $environment = $this->addEnvironment();
        $icon = $this->addIcon();

        $site = Site::create([
            'environment_id' => $environment->id,
            'icon_id' => $icon->id,
            'name' => 'Laravel',
            'url' => 'https://laravel.com'
        ]);

        return $site;
    }

    protected function addSites()
    {
        $environment = $this->addEnvironment();
        $icon = $this->addIcon();

        Site::create([
            'environment_id' => $environment->id,
            'icon_id' => $icon->id,
            'name' => 'Google',
            'url' => 'http://www.google.com'
        ]);

        Site::create([
            'environment_id' => $environment->id,
            'icon_id' => $icon->id,
            'name' => 'Bing',
            'url' => 'http://www.bing.com'
        ]);
    }
}
