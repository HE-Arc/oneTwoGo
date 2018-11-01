<?php

use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stories')->insert(
          [
            'user_id' => 0,
            'theme_id' => 0,

            'title' => 'My Little Poney',
            'text' => 'Yey!',
            'deleteVoted' => 0,
          ]
        );
    }
}
