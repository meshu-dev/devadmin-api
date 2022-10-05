<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Environment;

class EnvironmentTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/environments';

    protected $envStructure = [
        'id',
        'name'
    ];

    public function test_get_environment_by_id_success()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $this->json('GET', "{$this->url}/{$environment->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->envStructure
            ]);
    }

    public function test_get_environment_by_id_unauthenticated()
    {
        $environment = $this->addEnvironment();

        $this->testUnauthorised('GET', "{$this->url}/{$environment->id}");
    }

    public function test_get_environment_by_id_not_found()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $this->json('GET', "{$this->url}/9999")
            ->assertNotFound()
            ->assertJsonStructure([
                'data' => $this->envStructure
            ]);
    }

    public function test_get_list_of_environments_success()
    {
        $this->setupAuth();

        $this->addEnvironments();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => $this->envStructure
                ]
            ]);
    }

    public function test_get_list_of_environments_unauthenticated()
    {
        $this->addEnvironments();

        $this->testUnauthorised('GET', $this->url);
    }

    public function test_add_environment_success()
    {
        $this->setupAuth();

        $params = [
            'name' => 'Dev'
        ];

        $this->json('POST', $this->url, $params)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => $this->envStructure
            ])
            ->assertJson([
                'data' => [
                    'name' => 'Dev'
                ]
            ]);
    }

    public function test_add_environment_unauthenticated()
    {
        $params = [
            'name' => 'Dev'
        ];

        $this->testUnauthorised('POST', $this->url, $params);
    }

    public function test_edit_environment_success()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $id = $environment->id;
        $params = [
            'name' => 'Staging'
        ];

        $this->json('PUT', "{$this->url}/{$id}", $params)
            ->assertOk()
            ->assertJson([
                'data' => [
                    'id' => $id,
                    'name' => 'Staging'
                ]
            ]);
    }

    public function test_edit_environment_unauthenticated()
    {
        $environment = $this->addEnvironment();

        $id = $environment->id;
        $params = [
            'name' => 'Staging'
        ];

        $this->testUnauthorised('PUT', "{$this->url}/{$id}", $params);
    }

    public function test_delete_environment_success()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();
        $id = $environment->id;

        $this->json('DELETE', "{$this->url}/{$id}")
             ->assertNoContent();
    }

    public function test_delete_environment_unauthenticated()
    {
        $environment = $this->addEnvironment();
        $id = $environment->id;

        $this->testUnauthorised('DELETE', "{$this->url}/{$id}");
    }

    protected function addEnvironments()
    {
        $environmentNames = [
            ['name' => 'Production'],
            ['name' => 'Staging'],
            ['name' => 'Development']
        ];

        foreach ($environmentNames as $environmentName) {
            Environment::create($environmentName);
        }
    }
}
