<?php

namespace Database\Seeders;

use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectAttachment;
use App\Models\TestProjects\TestProjectTag;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// main database seeder
class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            UserSeeder::class,
            TestProjectSeeder::class,
            AssignmentSeeder::class
        ]);

    }
}
