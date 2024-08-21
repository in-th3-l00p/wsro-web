<?php

namespace Database\Seeders;

use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectAttachment;
use App\Models\TestProjects\TestProjectModule;
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

        // test project modules
        foreach (TestProject::all() as $testProject) {
            $modules = TestProjectModule::factory(rand(1, 4))
                ->create(["test_project_id" => $testProject->id]);
            // attachments
            foreach ($modules as $module) {
                $module->attachments()->saveMany($testProject
                    ->attachments()
                    ->limit(rand(1, min($testProject->attachments()->count(), 3)))
                    ->inRandomOrder()
                    ->get()
                );
            }

            $testProject->modules()->saveMany($modules);
        }
    }
}
