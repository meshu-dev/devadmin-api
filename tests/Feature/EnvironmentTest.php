<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

use App\Models\Environment;

class EnvironmentTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/environments';

    public function test_get_environment_by_id_success()
    {
        $environment = Environment::create(['name' => 'Production']);

        $this->json('GET', "{$this->url}/{$environment->id}")
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name'
                ]
            ]);
    }

    public function test_get_environments_success()
    {
        Environment::create(['name' => 'Production']);
        Environment::create(['name' => 'Staging']);
        Environment::create(['name' => 'Development']);

        $this->json('GET', $this->url)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name'
                    ]
                ]
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_add_environment_success()
    {
        $params = [
            'name' => 'Dev'
        ];

        $this->json('POST', $this->url, $params)
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'id' => 1,
                    'name' => 'Dev'
                ]
            ]);
    }

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
    }
}
