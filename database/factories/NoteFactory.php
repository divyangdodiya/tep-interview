<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $attachmentData = [];

        $numImages = $this->faker->numberBetween(0, 8);
        for ($i = 0; $i < $numImages; $i++) {
            $attachmentData[] = $this->faker->imageUrl;
        }
        return [
            'task_id' => Task::factory(),
            'subject' => $this->faker->sentence,
            'attachment' => json_encode($attachmentData),
            'note' => $this->faker->paragraph,
        ];
    }
}
