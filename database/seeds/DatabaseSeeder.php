<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => 'Muammer TOP',
            'email' => 'muammertop@outlook.com',
            'password' => bcrypt('123123'),
        ]);
    }
}
