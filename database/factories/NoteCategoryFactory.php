<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCategoryFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $note = Note::factory()->create();
        $category = Category::factory()->create();

        return [
            'note_id' => $note->id,
            'category_id' => $category->id,
        ];
    }
}