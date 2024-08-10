<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestProjectFactory extends Factory {
    public function definition(): array {
        return [
            "title" => fake()->sentence(4),
            "description" => fake()->text(),
            "owner_id" => User::query()
                ->where("role", "=", "admin")
                ->first()
                ->id,
            "visibility" => "public"
        ];
    }
}
