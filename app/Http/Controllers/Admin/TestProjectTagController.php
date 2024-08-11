<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use App\Models\TestProjectTag;
use Illuminate\Http\Request;

class TestProjectTagController extends Controller
{
    public function index(TestProject $testProject) {
    }

    public function create(TestProject $testProject) {
        return view("admin.test-projects.tags.create", [
            "testProject" => $testProject
        ]);
    }

    public function store(TestProject $testProject, Request $request) {
        $request->validate([
            "name" => "required|max:255"
        ]);
        $tag = TestProjectTag::query()
            ->where("name", "=", $request->name)
            ->first();
        if (!$tag)
            $tag = TestProjectTag::create([
                "name" => $request->name
            ]);
        $testProject->tags()->attach($tag);
        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([ "success" => __("Tag added!") ]);

    }

    public function show(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function edit(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function update(
        Request $request,
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function destroy(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }
}
