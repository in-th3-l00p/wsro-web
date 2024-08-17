<?php

namespace Database\Factories\Assignments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\AssignmentSubmissionText>
 */
class AssignmentSubmissionTextFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "text" => fake()->paragraph(),
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
