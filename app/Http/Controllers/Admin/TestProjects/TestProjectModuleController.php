<?php

namespace App\Http\Controllers\Admin\TestProjects;

use App\Http\Controllers\Controller;
use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TestProjectModuleController extends Controller
{
    public function create(TestProject $testProject)
    {
        Gate::authorize('create', TestProjectModule::class);
        return view('admin.test-projects.modules.create', [
            'testProject' => $testProject
        ]);
    }

    public function store(
        Request $request,
        TestProject $testProject
    )
    {
        Gate::authorize('create', TestProjectModule::class);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|exists:test_project_attachments,id',
        ]);

        $module = TestProjectModule::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'test_project_id' => $testProject->id,
        ]);
        if (isset($data["attachments"]))
            $module
                ->attachments()
                ->sync($data['attachments']);
        return redirect()->route('admin.test-projects.show', [
            'test_project' => $testProject,
        ]);
    }

    public function edit(
        TestProject       $testProject,
        TestProjectModule $module
    )
    {
        Gate::authorize('update', $module);
        return view('admin.test-projects.modules.edit', [
            'testProject' => $testProject,
            'module' => $module,
        ]);
    }

    public function update(
        Request           $request,
        TestProject       $testProject,
        TestProjectModule $module
    )
    {
        Gate::authorize('update', $module);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|exists:test_project_attachments,id',
        ]);

        $module->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if (isset($data["attachments"]))
            $module
                ->attachments()
                ->sync($data['attachments']);

        return redirect()->route('admin.test-projects.show', [
            'test_project' => $testProject,
        ]);
    }

    public function delete(
        TestProject       $testProject,
        TestProjectModule $module
    )
    {
        Gate::authorize('delete', $module);
        return view('admin.test-projects.modules.delete', [
            'testProject' => $testProject,
            'module' => $module,
        ]);
    }

    public function destroy(
        TestProject       $testProject,
        TestProjectModule $module
    )
    {
        Gate::authorize('delete', $module);
        $module->delete();
        return redirect()->route("admin.test-projects.show", [
            "test_project" => $testProject,
        ]);
    }
}
