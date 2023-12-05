<?php

namespace Database\Seeders;

use Database\Factories\NoteCategoryFactory;
use Illuminate\Database\Seeder;

class NoteCategorySeeder extends Seeder
{
    public function run()
    {
      NoteCategoryFactory::factory(50)->create();
    }
}