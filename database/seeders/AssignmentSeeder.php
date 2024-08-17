<?php

namespace Database\Seeders;

use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentAttachment;
use App\Models\Assignments\AssignmentSubmission;
use App\Models\Assignments\AssignmentSubmissionResource;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::factory(30)->create();
        AssignmentAttachment::factory(60)->create();

        foreach (Assignment::all() as $assignment) {
            $assignment
                ->users()
                ->attach(User::query()
                    ->inRandomOrder()
                    ->limit(rand(1, 3))
                    ->get());
        }

        AssignmentSubmission::factory(30)->create();
        foreach (AssignmentSubmission::all() as $submission) {
            AssignmentSubmissionResource::factory(rand(1, 3))
                ->create([
                    "assignment_submission_id" => $submission->id
                ]);
        }
    }
}
