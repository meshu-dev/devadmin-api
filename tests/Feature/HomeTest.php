<?php

namespace Tests\Feature;

use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_api_index_returns_timestamp()
    {
        $response = $this->get('/api');

        $response
            ->assertOk()
            ->assertJsonStructure(['time']);
    }
}
