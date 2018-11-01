<?php

use Illuminate\Database\Seeder;

class StoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 'theme_id' => 1,
     * @return void
     */
    public function run()
    {
      DB::table('stories')->insert(
        [
          'user_id' => 1,

          'title' => 'Lorem Ipsum 1',
          'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices, justo eu vulputate consequat, massa elit sodales enim, in aliquam nisi purus eu elit. Proin consequat tempus ligula, sed viverra dolor luctus ac. Pellentesque quis viverra lorem. Nam tellus sem, pretium sed libero non, fringilla maximus ipsum. In a orci pulvinar, hendrerit dolor nec, cursus augue. Vestibulum dignissim non erat vel rutrum. Maecenas sed diam sit amet nibh tincidunt interdum non in risus. Quisque ultrices ex dolor, in maximus mauris ullamcorper sit amet. Morbi eget nisl nibh. Praesent suscipit quis purus sit amet pharetra. Donec pellentesque suscipit purus, ut dapibus lectus. Maecenas in dignissim magna. Nunc mauris est, rutrum eu semper id, posuere non velit. Nam molestie commodo elit hendrerit volutpat. Nunc ac dapibus metus, a varius mauris. ',
          'deleteVoted' => 0,
        ]
      );

        DB::table('stories')->insert(
          [
            'user_id' => 1,

            'title' => 'Lorem Ipsum 2',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices, justo eu vulputate consequat, massa elit sodales enim, in aliquam nisi purus eu elit. Proin consequat tempus ligula, sed viverra dolor luctus ac. Pellentesque quis viverra lorem. Nam tellus sem, pretium sed libero non, fringilla maximus ipsum. In a orci pulvinar, hendrerit dolor nec, cursus augue. Vestibulum dignissim non erat vel rutrum. Maecenas sed diam sit amet nibh tincidunt interdum non in risus. Quisque ultrices ex dolor, in maximus mauris ullamcorper sit amet. Morbi eget nisl nibh. Praesent suscipit quis purus sit amet pharetra. Donec pellentesque suscipit purus, ut dapibus lectus. Maecenas in dignissim magna. Nunc mauris est, rutrum eu semper id, posuere non velit. Nam molestie commodo elit hendrerit volutpat. Nunc ac dapibus metus, a varius mauris. ',
            'deleteVoted' => 0,
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 1,

            'title' => 'Lorem Ipsum 3',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices, justo eu vulputate consequat, massa elit sodales enim, in aliquam nisi purus eu elit. Proin consequat tempus ligula, sed viverra dolor luctus ac. Pellentesque quis viverra lorem. Nam tellus sem, pretium sed libero non, fringilla maximus ipsum. In a orci pulvinar, hendrerit dolor nec, cursus augue. Vestibulum dignissim non erat vel rutrum. Maecenas sed diam sit amet nibh tincidunt interdum non in risus. Quisque ultrices ex dolor, in maximus mauris ullamcorper sit amet. Morbi eget nisl nibh. Praesent suscipit quis purus sit amet pharetra. Donec pellentesque suscipit purus, ut dapibus lectus. Maecenas in dignissim magna. Nunc mauris est, rutrum eu semper id, posuere non velit. Nam molestie commodo elit hendrerit volutpat. Nunc ac dapibus metus, a varius mauris. ',
            'deleteVoted' => 0,
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 1,

            'title' => 'Lorem Ipsum 4',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices, justo eu vulputate consequat, massa elit sodales enim, in aliquam nisi purus eu elit. Proin consequat tempus ligula, sed viverra dolor luctus ac. Pellentesque quis viverra lorem. Nam tellus sem, pretium sed libero non, fringilla maximus ipsum. In a orci pulvinar, hendrerit dolor nec, cursus augue. Vestibulum dignissim non erat vel rutrum. Maecenas sed diam sit amet nibh tincidunt interdum non in risus. Quisque ultrices ex dolor, in maximus mauris ullamcorper sit amet. Morbi eget nisl nibh. Praesent suscipit quis purus sit amet pharetra. Donec pellentesque suscipit purus, ut dapibus lectus. Maecenas in dignissim magna. Nunc mauris est, rutrum eu semper id, posuere non velit. Nam molestie commodo elit hendrerit volutpat. Nunc ac dapibus metus, a varius mauris. ',
            'deleteVoted' => 0,
          ]
        );

        DB::table('stories')->insert(
          [
            'user_id' => 1,

            'title' => 'Lorem Ipsum 5',
            'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis ultrices, justo eu vulputate consequat, massa elit sodales enim, in aliquam nisi purus eu elit. Proin consequat tempus ligula, sed viverra dolor luctus ac. Pellentesque quis viverra lorem. Nam tellus sem, pretium sed libero non, fringilla maximus ipsum. In a orci pulvinar, hendrerit dolor nec, cursus augue. Vestibulum dignissim non erat vel rutrum. Maecenas sed diam sit amet nibh tincidunt interdum non in risus. Quisque ultrices ex dolor, in maximus mauris ullamcorper sit amet. Morbi eget nisl nibh. Praesent suscipit quis purus sit amet pharetra. Donec pellentesque suscipit purus, ut dapibus lectus. Maecenas in dignissim magna. Nunc mauris est, rutrum eu semper id, posuere non velit. Nam molestie commodo elit hendrerit volutpat. Nunc ac dapibus metus, a varius mauris. ',
            'deleteVoted' => 0,
          ]
        );
    }
}
