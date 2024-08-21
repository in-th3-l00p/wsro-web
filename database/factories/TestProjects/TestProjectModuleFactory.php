<?php

namespace Database\Factories\TestProjects;

use App\Models\TestProjects\TestProject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TestProjects\TestProjectModule>
 */
class TestProjectModuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => "Module " . fake()->randomLetter(),
            'description' => fake()->sentence(),
            'test_project_id' => TestProject::query()
                ->inRandomOrder()
                ->first()
                ->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
