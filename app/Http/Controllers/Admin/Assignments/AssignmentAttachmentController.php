<?php

namespace App\Http\Controllers\Admin\Assignments;

use App\Http\Controllers\Controller;
use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class AssignmentAttachmentController extends Controller
{
    public function index(Assignment $assignment)
    {
        Gate::authorize(
            'viewAny',
            [AssignmentAttachment::class, $assignment],
        );

        return view('admin.assignments.attachments.index', [
            'assignment' => $assignment,
            'attachments' => $assignment
                ->attachments()
                ->latest()
                ->get(),
        ]);
    }

    public function create(Assignment $assignment)
    {
        Gate::authorize('create', AssignmentAttachment::class);

        return view('admin.assignments.attachments.create', [
            'assignment' => $assignment,
        ]);
    }

    public function store(Request $request, Assignment $assignment)
    {
        Gate::authorize('create', AssignmentAttachment::class);

        $request->validate([
            'name' => 'required|max:255',
            'file' => ['required', File::default()],
        ]);

        // Check for unique name within the assignment
        if ($assignment
            ->attachments()
            ->where('name', $request->name)
            ->exists()
        ) {
            return back()->withErrors([
                'name' => __('The name field should be unique within the assignment.'),
            ]);
        }

        $file = $request->file('file');

        $attachment = AssignmentAttachment::create([
            'name' => $file->getClientOriginalName(),
            'path' => '',
            'assignment_id' => $assignment->id,
        ]);

        $path = Storage::putFileAs(
            "assignments/{$assignment->id}/attachments",
            $file,
            $attachment->id . '_' . $file->getClientOriginalName()
        );

        $attachment->update([
            'path' => $path,
        ]);

        return redirect()
            ->route('admin.assignments.show', $assignment)
            ->with('success', 'Attachment added successfully!');
    }

    public function show(Assignment $assignment, AssignmentAttachment $attachment)
    {
        Gate::authorize('view', $attachment);

        // Ensure the attachment belongs to the assignment
        if ($attachment->assignment_id !== $assignment->id) {
            abort(404);
        }

        return Storage::download($attachment->path, $attachment->name);
    }

    public function edit(Assignment $assignment, AssignmentAttachment $attachment)
    {
        Gate::authorize('update', $attachment);

        if ($attachment->assignment_id !== $assignment->id) {
            abort(404);
        }

        return view('admin.assignments.attachments.edit', [
            'assignment' => $assignment,
            'attachment' => $attachment,
        ]);
    }

    public function update(
        Request $request,
        Assignment $assignment,
        AssignmentAttachment $attachment
    ) {
        Gate::authorize('update', $attachment);

        if ($attachment->assignment_id !== $assignment->id) {
            abort(404);
        }

        $request->validate([
            'name' => 'nullable|string|max:255',
            'file' => ['nullable', File::default()],
        ]);

        $data = [];

        if ($request->filled('name')) {
            // Check for unique name within the assignment
            if ($assignment->attachments()->where('name', $request->name)->where('id', '!=', $attachment->id)->exists()) {
                return back()->withErrors([
                    'name' => __('The name field should be unique within the assignment.'),
                ]);
            }
            $data['name'] = $request->name;
        }

        if ($request->hasFile('file')) {
            // Delete old file
            Storage::delete($attachment->path);

            // Upload new file
            $file = $request->file('file');
            $path = Storage::putFileAs(
                "assignments/{$assignment->id}/attachments",
                $file,
                $attachment->id . '_' . $file->getClientOriginalName()
            );
            $data['path'] = $path;
            $data['name'] = $file->getClientOriginalName();
        }

        if (!empty($data)) {
            $attachment->update($data);
        }

        return redirect()
            ->route('admin.assignments.show', $assignment)
            ->with('success', 'Attachment updated successfully!');
    }

    public function delete(
        Assignment $assignment,
        AssignmentAttachment $attachment
    ) {
        Gate::authorize('delete', $attachment);

        if ($attachment->assignment_id !== $assignment->id) {
            abort(404);
        }

        return view('admin.assignments.attachments.delete', [
            'assignment' => $assignment,
            'attachment' => $attachment,
        ]);
    }

    public function destroy(
        Assignment $assignment,
        AssignmentAttachment $attachment
    ) {
        Gate::authorize('delete', $attachment);

        if ($attachment->assignment_id !== $assignment->id) {
            abort(404);
        }

        // Delete the file
        Storage::delete($attachment->path);

        // Soft delete the attachment
        $attachment->delete();

        return redirect()
            ->route('admin.assignments.show', $assignment)
            ->with('success', 'Attachment deleted successfully!');
    }

    public function trash(Assignment $assignment)
    {
        Gate::authorize('viewTrashed', AssignmentAttachment::class);

        $attachments = AssignmentAttachment::onlyTrashed()
            ->where('assignment_id', $assignment->id)
            ->latest()
            ->get();

        return view('admin.assignments.attachments.trash', [
            'assignment' => $assignment,
            'attachments' => $attachments,
        ]);
    }

    public function restore(
        Assignment $assignment,
        AssignmentAttachment $attachment
    ) {
        Gate::authorize('restore', $attachment);
        $attachment->restore();

        return redirect()
            ->route('admin.assignments.show', $assignment)
            ->with('success', 'Attachment restored successfully!');
    }
}
