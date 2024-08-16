<?php

namespace Database\Seeders;

use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentAttachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::factory(30)->create();
        AssignmentAttachment::factory(60)->create();
    }
}
