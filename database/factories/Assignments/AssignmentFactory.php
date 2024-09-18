<?php

namespace Database\Factories\Assignments;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\Assignment>
 */
class AssignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->sentence(4),
            "description" => fake()->paragraph(),
            "deadline" => fake()->dateTimeBetween("now", "+1 month"),
            "owner_id" => User::query()->inRandomOrder()->first()->id,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
