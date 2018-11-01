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
        $this->call(UsersSeeder::class);
        $this->call(StoriesSeeder::class);
        $this->call(ThemeSeeder::class);
        $this->call(ConstraintSeeder::class);
        $this->call(ConstraintThemeSeeder::class);
    }
}
