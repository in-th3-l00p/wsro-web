<?php

namespace Database\Seeders;

use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentAttachment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::factory(30)->create();
        AssignmentAttachment::factory(60)->create();

        $usersWithAssignments = User::query()
            ->inRandomOrder()
            ->limit(User::query()->count() / 2)
            ->get();
        foreach ($usersWithAssignments as $user) {
            $user
                ->assignedAssignments()
                ->attach(
                    Assignment::query()
                        ->inRandomOrder()
                        ->limit(rand(0, 5))
                        ->get()
                );
        }
    }
}
