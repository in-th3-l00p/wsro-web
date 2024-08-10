<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestProjectRequest;
use App\Models\TestProject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

const TEST_PROJECTS_PER_PAGE = 15;

class TestProjectController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProject::class);
        return view("admin.testProjects.index", [
            "testProjects" => TestProject::query()->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    public function create() {
        Gate::authorize("create", TestProject::class);
        return view("admin.testProjects.create");
    }

    public function store(TestProjectRequest $request) {
        $testProject = TestProject::create([
            ...$request->all(),
            "owner_id" => Auth::user()->id
        ]);

        return redirect()->route("admin.testProjects.show", [
            "test_project" => $testProject
        ]);
    }

    public function show(TestProject $testProject) {
        Gate::authorize("view", $testProject);
        return view("admin.testProjects.show", [
            "testProject" => $testProject
        ]);
    }

    public function edit(TestProject $testProject) {
        Gate::authorize("update", $testProject);
        return view("admin.testProjects.edit", [
            "testProject" => $testProject
        ]);
    }

    public function update(
        TestProjectRequest $request,
        TestProject $testProject
    ) {
        $testProject->update($request->all());
        return view("admin.testProjects.show", [
            "testProject" => $testProject
        ]);
    }

    public function delete(TestProject $testProject) {
        Gate::authorize("delete", $testProject);
        return view("admin.testProjects.delete", [
            "testProject" => $testProject
        ]);
    }

    public function destroy(TestProject $testProject) {
        Gate::authorize("delete", $testProject);
        $testProject->delete();
        return redirect()
            ->route("admin.testProjects.index")
            ->with([ "success" => "Test project deleted!" ]);
    }

    public function trash() {
        Gate::authorize("viewTrashed", TestProject::class);
        return view("admin.testProjects.trash", [
            "testProjects" => TestProject::onlyTrashed()
                ->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    public function restore(TestProject $testProject) {
        Gate::authorize("restore", TestProject::class);
        $testProject->restore();
        return redirect()->route("admin.testProjects.show", [
            "test_project" => $testProject
        ]);
    }
}
