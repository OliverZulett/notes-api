<?php

namespace Database\Seeders;

use Database\Seeders\NoteCategorySeeder as SeedersNoteCategorySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        (new UsersSeeder)->run();
        (new CategoriesSeeder)->run();
        (new NotesSeeder)->run();
    }
}
