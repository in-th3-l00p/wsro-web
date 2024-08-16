<?php

namespace Database\Factories\TestProjects;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestProjects\TestProjectTag>
 */
class TestProjectTagFactory extends Factory {
    public function definition(): array {
        return [
            "name" => fake()->randomElement([
                fake()->randomElement(["backend", "frontend", "framework", "nationals"]),
                fake()->year()
            ])
        ];
    }
}
