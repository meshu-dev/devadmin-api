<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(App\User::class)->create([
		    'name' => env('USER_NAME', 'Test user'),
		    'email' => env('USER_EMAIL', 'example@mail.com')
		]);
    }
}
