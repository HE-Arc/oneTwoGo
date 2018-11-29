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
            'name' => 'admin',
            'email' => 'admin@onetwogo.ch',
            'admin' => 1,
            'password' => '$2y$10$nQijRRvqnwcQ9J6JHS7gGus8x7QGiC84oyf991Xmka6jGcYZhapOe', //123456
          ]
        );

        DB::table('users')->insert(
          [
            'name' => 'user',
            'email' => 'user@onetwogo.ch',
            'admin' => 0,
            'password' => '$2y$10$imNJDAlQExa4zU7R9wF0EuJMUhs6ED376BQRM/W4ZP2ND9Y50Zuni', //123456
          ]
        );
    }
}
