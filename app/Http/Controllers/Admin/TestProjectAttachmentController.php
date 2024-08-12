<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use App\Models\TestProjectAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestProjectAttachmentController extends Controller {
    public function index(TestProject $testProject) {
        return view("admin.test-projects.attachments.index", [
            "testProject" => $testProject,
            "attachments" => $testProject
                ->attachments()
                ->latest()
                ->get()
        ]);
    }

    public function create(TestProject $testProject) {
        return view("admin.test-projects.attachments.create", [
            "testProject" => $testProject
        ]);
    }

    public function store(
        TestProject $testProject,
        Request $request
    ) {
        $request->validate([
            "file" => "required|file|max:5mb"
        ]);

        $attachment = TestProjectAttachment::create([
            "name" => $request->file()->get(),
            "path" => "",
            "test_project_id" => $testProject->id
        ]);
        $path =  Storage::put(
            "$testProject->id/$attachment->id",
            $request->file()
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
        return Storage::download($attachment->path);
    }

    public function edit(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
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
        return view("admin.test-projects.attachments.delete", [
            "attachment" => $attachment,
            "testProject" => $testProject
        ]);
    }

    public function destroy(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
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
        return view("admin.test-projects.attachments.trash", [
            "testProject" => $testProject,
            "attachments" => TestProjectAttachment::withTrashed()
                ->where("test_project_id", "=", $testProject->id)
                ->latest()
                ->get()
        ]);
    }

    public function restore(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
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
