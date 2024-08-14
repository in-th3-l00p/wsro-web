<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestProjectRequest;
use App\Models\TestProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

const TEST_PROJECTS_PER_PAGE = 15;

class TestProjectController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProject::class);
        return view("admin.test-projects.index", [
            "testProjects" => TestProject::query()->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    public function create() {
        Gate::authorize("create", TestProject::class);
        return view("admin.test-projects.create");
    }

    public function store(TestProjectRequest $request) {
        $testProject = TestProject::create([
            ...$request->all(),
            "owner_id" => Auth::user()->id
        ]);

        return redirect()->route("admin.test-projects.show", [
            "test_project" => $testProject
        ]);
    }

    public function show(TestProject $testProject) {
        Gate::authorize("view", $testProject);
        return view("admin.test-projects.show", [
            "testProject" => $testProject
        ]);
    }

    public function edit(TestProject $testProject) {
        Gate::authorize("update", $testProject);
        return view("admin.test-projects.edit", [
            "testProject" => $testProject
        ]);
    }

    public function update(
        Request $request,
        TestProject $testProject
    ) {
        $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:1000",
//            "status" => "required|in:public,private,draft"
        ]);
        if ($request->title !== $testProject->title)
            $testProject->update([
                "title" => $request->title
            ]);
        if ($request->description !== $testProject->description)
            $testProject->update([
                "description" => $request->description
            ]);
        if ($request->status !== $testProject->status)
            $testProject->update([
                "status" => $request->status
            ]);
        return view("admin.test-projects.show", [
            "testProject" => $testProject
        ]);
    }

    public function delete(TestProject $testProject) {
        Gate::authorize("delete", $testProject);
        return view("admin.test-projects.delete", [
            "testProject" => $testProject
        ]);
    }

    public function destroy(TestProject $testProject) {
        Gate::authorize("delete", $testProject);
        $testProject->delete();
        return redirect()
            ->route("admin.test-projects.index")
            ->with([ "success" => "Test project deleted!" ]);
    }

    public function trash() {
        Gate::authorize("viewTrashed", TestProject::class);
        return view("admin.test-projects.trash", [
            "testProjects" => TestProject::onlyTrashed()
                ->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    public function restore(TestProject $testProject) {
        Gate::authorize("restore", $testProject);
        $testProject->restore();
        return redirect()->route("admin.test-projects.show", [
            "test_project" => $testProject
        ]);
    }
}
