<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_success()
    {
        $userEmail = time() . '@example.com';
        $userPassword = '123456789';

        User::create([
            'name' => 'Test',
            'email'=> $userEmail,
            'password' => bcrypt($userPassword)
        ]);

        /*
        $user = User::factory()->create([
            'name' => 'Abigail',
        ]); */

        $response = $this->json('POST', route('login'), [
            'email' => $userEmail,
            'password' => $userPassword,
        ]);

        $response->assertStatus(200);
    }
}
