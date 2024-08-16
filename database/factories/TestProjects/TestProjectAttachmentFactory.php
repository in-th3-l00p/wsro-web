<?php

namespace Database\Factories\TestProjects;

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
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestProjects\TestProjectAttachment>
 */
class TestProjectAttachmentFactory extends Factory
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
            "path" => $file
        ];
    }
}
