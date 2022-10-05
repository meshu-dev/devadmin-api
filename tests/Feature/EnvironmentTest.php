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

    public function test_getting_environment_by_id()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $this->json('GET', "{$this->url}/{$environment->id}")
            ->assertOk()
            ->assertJsonStructure([
                'data' => $this->envStructure
            ]);
    }

    public function test_stop_getting_environment_by_id_with_no_token()
    {
        $environment = $this->addEnvironment();

        $this->testUnauthorised('GET', "{$this->url}/{$environment->id}");
    }

    public function test_getting_empty_environment_by_invalid_id()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $this->json('GET', "{$this->url}/9999")
             ->assertStatus(422);
    }

    public function test_getting_list_of_environments()
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

    public function test_stop_getting_list_of_environments_with_no_token()
    {
        $this->addEnvironments();

        $this->testUnauthorised('GET', $this->url);
    }

    public function test_getting_empty_list_of_environments()
    {
        $this->setupAuth();

        $this->json('GET', $this->url)
            ->assertOk()
            ->assertJson([
                'data' => []
            ]);
    }

    public function test_adding_environment()
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

    public function test_stop_adding_environment_with_no_token()
    {
        $params = [
            'name' => 'Dev'
        ];

        $this->testUnauthorised('POST', $this->url, $params);
    }

    public function test_stop_adding_environment_with_duplicate_name()
    {
        $this->setupAuth();

        $this->addEnvironment();

        $params = [
            'name' => 'Production'
        ];

        $this->json('POST', $this->url, $params)
             ->assertStatus(422);
    }

    public function test_editing_environment()
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

    public function test_stop_editing_environment_with_no_token()
    {
        $environment = $this->addEnvironment();

        $id = $environment->id;
        $params = [
            'name' => 'Staging'
        ];

        $this->testUnauthorised('PUT', "{$this->url}/{$id}", $params);
    }

    public function test_stop_editing_environment_with_duplicate_name()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();

        $id = $environment->id;
        $params = [
            'name' => 'Production'
        ];

        $this->json('PUT', "{$this->url}/{$id}", $params)
             ->assertStatus(422);
    }

    public function test_deleting_environment()
    {
        $this->setupAuth();

        $environment = $this->addEnvironment();
        $id = $environment->id;

        $this->json('DELETE', "{$this->url}/{$id}")
             ->assertNoContent();
    }

    public function test_stop_deleting_environment_with_no_token()
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
