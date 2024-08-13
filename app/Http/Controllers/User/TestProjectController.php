<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use Illuminate\Support\Facades\Gate;

const TEST_PROJECTS_PER_PAGE = 15;

class TestProjectController extends Controller {
    public function index() {
        Gate::authorize("viewAny", TestProject::class);
        return view("user.test-projects.index", [
            "testProjects" => TestProject::query()
                ->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    public function show(TestProject $testProject) {
        Gate::authorize("view", $testProject);
        return view("user.test-projects.show", [
            "testProject" => $testProject
        ]);
    }
}
