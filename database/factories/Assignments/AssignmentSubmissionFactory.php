<?php

namespace Database\Factories\Assignments;

use App\Models\Assignments\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\AssignmentSubmission>
 */
class AssignmentSubmissionFactory extends Factory
{
    public function definition(): array
    {
        $assignment = Assignment::query()
            ->withCount("users")
            ->inRandomOrder()
            ->first();

        return [
            "assignment_id" => $assignment->id,
            "user_id" => fake()
                ->randomElement($assignment->users()->get())
                ->id,
            "description" => fake()->text(),
            "status" => fake()->randomElement([ "assigned", "turned_in" ])
        ];
    }
}
