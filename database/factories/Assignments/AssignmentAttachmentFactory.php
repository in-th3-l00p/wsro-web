<?php

namespace Database\Factories\Assignments;

use App\Models\Assignments\Assignment;
use Illuminate\Database\Eloquent\Factories\Factory;

// demo file array
const FILES = [
    "public/demo/Day1-A.docx",
    "public/demo/Day1-B.docx",
    "public/demo/Day1-mediafiles.zip",
    "public/demo/Day2-mediafiles.zip",
    "public/demo/Day2.docx",
];

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Assignments\AssignmentAttachment>
 */
class AssignmentAttachmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $file = fake()->randomElement(FILES);
        $exploded = explode("/", $file);

        return [
            "name" => $exploded[sizeof($exploded) - 1],
            "path" => $file,
            "assignment_id" => Assignment::query()
                ->inRandomOrder()
                ->first()
                ->id,
            "created_at" => now(),
            "updated_at" => now()
        ];
    }
}
