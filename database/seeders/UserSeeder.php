<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => env('USER_NAME', 'Test user'),
            'email' => env('USER_EMAIL', 'example@mail.com')
        ]);
    }
}
