<?php

namespace Database\Factories\Assignments;

use Illuminate\Database\Eloquent\Factories\Factory;

// demo file array
const FILES = [
    "/demo/Day1-A.docx",
    "/demo/Day1-B.docx",
    "/demo/Day1-mediafiles.zip",
    "/demo/Day2-mediafiles.zip",
    "/demo/Day2.docx",
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
        return [
            //
        ];
    }
}
