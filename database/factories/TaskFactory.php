<?php

namespace Database\Factories;

use App\Models\Label;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use Illuminate\Support\Str;
use App\Models\TaskStatus;
use App\Models\User;

class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = TaskStatus::inRandomOrder()->first();
        $label = Label::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'name' => $this->faker->name(),
            'description' => Str::random(10),
            'status_id' => $status->id,
            'label_id' => $label->id,
            'created_by_id' => $user->id,
        ];
    }
}
