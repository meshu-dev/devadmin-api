<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

use Laravel\Sanctum\Sanctum;
use App\Models\User;
use App\Models\Environment;
use App\Models\Icon;

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

    protected function getInvalidId()
    {
        return 9999;
    }

    protected function addEnvironment()
    {
        return Environment::create(['name' => 'Production']);
    }

    protected function addIcon($params = [])
    {
        return Icon::create([
            'name' => $params['name'] ?? 'PHP',
            'url' => $params['url'] ?? 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-plain.svg'
        ]);
    }
}
