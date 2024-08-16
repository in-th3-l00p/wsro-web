<?php

namespace Database\Seeders;

use App\Models\Assignments\Assignment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        Assignment::factory(20)->create();
    }
}
