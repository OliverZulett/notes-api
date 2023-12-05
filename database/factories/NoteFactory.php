<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    protected $model = Note::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        return [
            'id' => $this->faker->uuid(),
            'title' => $this->faker->words(rand(2, 10), true),
            'content' => $this->faker->words(rand(20, 100), true),
            'user_id' => $users[rand(0, count($users) - 1)],
        ];
    }
}
