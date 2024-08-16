<?php

namespace Database\Factories\Assignments;

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
            "name" => fake()->words(),
            "description" => fake()->paragraph(),
            "deadline" => fake()->dateTimeBetween(now(), "+1 month")
        ];
    }
}
