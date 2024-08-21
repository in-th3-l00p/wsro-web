<?php

namespace Database\Factories\Assignments;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\AssignmentSubmissionLink>
 */
class AssignmentSubmissionLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "link" => fake()->url(),
            "created_at" => now(),
            "updated_at" => now(),
        ];
    }
}
