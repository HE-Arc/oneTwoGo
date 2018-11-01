<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
          [
            'name' => 'dev',
            'email' => 'dev@onetwogo.ch',
            'password' => '$2y$10$3LCwLde98lZrCx7INSVIC.C26YRhq40s54FG4xaNaW5KFwTSe/sWy',
          ]
        );
    }
}
