<?php

use Illuminate\Database\Seeder;

class VotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('votes')->insert(
        [
          'user_id' => 1,
          'story_id' => 1,
          'vote' => 1,
        ]
      );

      DB::table('votes')->insert(
        [
          'user_id' => 1,
          'story_id' => 2,
          'vote' => -1,
        ]
      );
    }
}
