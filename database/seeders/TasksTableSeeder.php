<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::factory(20)->create()->each(function ($task) {
            Note::factory(rand(1, 9))->create(['task_id' => $task->id]);
        });
    }
}
