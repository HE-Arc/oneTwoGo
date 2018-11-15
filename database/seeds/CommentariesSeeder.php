<?php

use Illuminate\Database\Seeder;

class CommentariesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('commentaries')->insert(
        [
          'user_id' => 1,
          'story_id' => 1,
          'comment' => 'Me gusta los nachos',
        ]
      );

      DB::table('commentaries')->insert(
        [
          'user_id' => 1,
          'story_id' => 2,
          'comment' => 'Me gusta los nachos muchos',
        ]
      );
    }
}
