<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TestProjectController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProject::class);
        return view("admin.testProject.index", [
            "testProjects" => TestProject::all()
        ]);
    }

    public function create() {
        Gate::authorize("create", TestProject::class);
    }

    public function store(Request $request) {
        Gate::authorize("create", TestProject::class);
    }

    public function show(TestProject $testProject) {
        Gate::authorize("view", $testProject);
    }

    public function edit(TestProject $testProject) {
        Gate::authorize("update", $testProject);
    }

    public function update(Request $request, TestProject $testProject) {
        Gate::authorize("update", $testProject);
    }

    public function destroy(TestProject $testProject) {
        Gate::authorize("delete", $testProject);
    }
}
