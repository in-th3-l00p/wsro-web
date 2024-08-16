<?php

namespace Database\Seeders;

use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectAttachment;
use App\Models\TestProjects\TestProjectTag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
