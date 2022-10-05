<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Environment;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setupAuth()
    {
        Sanctum::actingAs(User::factory()->create());
    }

    protected function testUnauthorised(
        $type,
        $url,
        $params = []
    ) {
        $this->json($type, $url, $params)
            ->assertUnauthorized()
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    protected function addEnvironment()
    {
        return Environment::create(['name' => 'Production']);
    }
}
