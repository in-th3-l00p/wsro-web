<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProjects\TestProject;
use App\Models\TestProjects\TestProjectAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class TestProjectAttachmentController extends Controller {
    public function index(TestProject $testProject) {
        Gate::authorize("viewAny", TestProjectAttachment::class);
        return view("admin.test-projects.attachments.index", [
            "testProject" => $testProject,
            "attachments" => $testProject
                ->attachments()
                ->latest()
                ->get()
        ]);
    }

    public function create(TestProject $testProject) {
        Gate::authorize("create", TestProjectAttachment::class);
        return view("admin.test-projects.attachments.create", [
            "testProject" => $testProject
        ]);
    }

    public function store(
        TestProject $testProject,
        Request $request
    ) {
        Gate::authorize("create", TestProjectAttachment::class);
        $request->validate([
            "name" => "required|max:255",
            "file" => ["required", File::default()]
        ]);

        if ($testProject
            ->attachments()
            ->where("name", "=", $request->name)
            ->count() !== 0)
            return back()->withErrors([
                "name" => __("The name field should be unique within the text project.")
            ]);

        $attachment = TestProjectAttachment::create([
            "name" => $request->file("file")->getClientOriginalName(),
            "path" => "",
            "test_project_id" => $testProject->id
        ]);
        $path =  Storage::put(
            "$testProject->id/$attachment->id",
            $request->file("file")
        );
        $attachment->update([
            "path" => $path
        ]);
        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([
                "success" => "Attachment added successfully!"
            ]);
    }

    public function show(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("view", $attachment);
        return Storage::download(
            $attachment->path,
            $attachment->name
        );
    }

    public function edit(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("update", $attachment);
        return view("admin.test-projects.attachments.edit", [
            "testProject" => $testProject,
            "attachment" => $attachment
        ]);
    }

    public function update(
        Request $request,
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("update", $attachment);
        $request->validate([
            "name" => "nullable|string|max:1024",
            "file" => "nullable|file|max:5mb"
        ]);

        if ($request->name)
            $attachment->update([
                "name" => $request->name
            ]);
        if ($request->hasFile("file")) {
            Storage::delete($attachment->path);
            $path = Storage::put(
                "$testProject->id/$attachment->id",
                $request->file()
            );
            $attachment->update([
                "path" => $path
            ]);
        }

        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([
                "success" => "Attachment updated successfully!"
            ]);
    }

    public function delete(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("delete", $attachment);
        return view("admin.test-projects.attachments.delete", [
            "attachment" => $attachment,
            "testProject" => $testProject
        ]);
    }

    public function destroy(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("delete", $attachment);
        $attachment->delete();
        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([
                "success" => __("Attachment deleted successfully!")
            ]);
    }

    public function trash(TestProject $testProject) {
        Gate::authorize("viewAny", TestProjectAttachment::class);
        return view("admin.test-projects.attachments.trash", [
            "testProject" => $testProject,
            "attachments" => TestProjectAttachment::onlyTrashed()
                ->where("test_project_id", "=", $testProject->id)
                ->latest()
                ->get()
        ]);
    }

    public function restore(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("restore", $attachment);
        $attachment->restore();
        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([
                "success" => "Attachment restored successfully!"
            ]);
    }
}
