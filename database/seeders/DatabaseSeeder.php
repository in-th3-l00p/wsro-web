<?php

namespace Database\Seeders;

use App\Models\TestProject;
use App\Models\TestProjectAttachment;
use App\Models\TestProjectTag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// main database seeder
class DatabaseSeeder extends Seeder {
    public function run(): void {
        // user seedin'
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin'
        ]);
        User::factory(30)->create();

        // test project seedin'
        TestProject::factory(10)->create();
        TestProject::factory(5)->create([
            "visibility" => "private"
        ]);
        TestProject::factory(5)->create([
            "visibility" => "draft"
        ]);

        // test project tagggsss
        TestProjectTag::factory(10)->create();
        foreach (TestProject::all() as $testProject) {
            $tagsCount = rand(0, 4);
            $tags = TestProjectTag::all()->shuffle();
            for ($i = 0; $i < $tagsCount; $i++) {
                $testProject
                    ->tags()
                    ->attach($tags[$i]->id);
            }
        }

        // test project attachments
        foreach (TestProject::all() as $testProject)
            TestProjectAttachment::factory(rand(0, 4))
                ->create([ "test_project_id" => $testProject->id ]);
    }
}
