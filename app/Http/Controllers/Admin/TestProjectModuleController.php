<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectModule;
use Illuminate\Http\Request;

class TestProjectModuleController extends Controller
{
    public function create(TestProject $testProject)
    {
        return view('admin.test-projects.modules.create', [
            'testProject' => $testProject
        ]);
    }

    public function store(Request $request, TestProject $testProject)
    {
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
        TestProjectModule $testProjectModule
    )
    {
        return view('admin.test-projects.modules.edit', [
            'testProject' => $testProject,
            'testProjectModule' => $testProjectModule,
        ]);
    }

    public function update(
        Request           $request,
        TestProject       $testProject,
        TestProjectModule $testProjectModule
    )
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|exists:test_project_attachments,id',
        ]);

        $testProjectModule->update([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        if (isset($data["attachments"]))
            $testProjectModule
                ->attachments()
                ->sync($data['attachments']);

        return redirect()->route('admin.test-projects.show', [
            'test_project' => $testProject,
        ]);
    }

    public function delete(
        TestProject       $testProject,
        TestProjectModule $testProjectModule
    )
    {
        return view('admin.test-projects.modules.delete', [
            'testProject' => $testProject,
            'testProjectModule' => $testProjectModule,
        ]);
    }

    public function destroy(
        TestProject       $testProject,
        TestProjectModule $testProjectModule
    )
    {
        $testProjectModule->delete();
        return redirect()->route("admin.test-projects.show", [
            "test_project" => $testProject,
        ]);
    }
}
