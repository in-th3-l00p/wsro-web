<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

const TEST_PROJECTS_PER_PAGE = 15;

class TestProjectController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProject::class);
        return view("user.test-projects.index", [
            "testProjects" => TestProject::query()
                ->paginate(TEST_PROJECTS_PER_PAGE)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(TestProject $testProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestProject $testProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestProject $testProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestProject $testProject)
    {
        //
    }
}
