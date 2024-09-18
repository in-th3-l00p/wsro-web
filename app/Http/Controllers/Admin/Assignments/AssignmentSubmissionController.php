<?php

namespace App\Http\Controllers\Admin\Assignments;

use App\Http\Controllers\Controller;
use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AssignmentSubmissionController extends Controller
{
    public function index(Assignment $assignment)
    {
        Gate::authorize('viewAny', [
            AssignmentSubmission::class,
            $assignment
        ]);
        $submissions = $assignment
            ->submissions()
            ->with('user')
            ->latest()
            ->get();
        return view(
            'admin.assignments.submissions.index',
            compact('assignment', 'submissions')
        );
    }

    public function show(
        Assignment $assignment,
        AssignmentSubmission $submission
    ) {
        Gate::authorize('view', [$submission, $assignment]);
        $submission->load(['user', 'resources']);
        return view(
            'admin.assignments.submissions.show',
            compact('assignment', 'submission')
        );
    }

    public function edit(
        Assignment $assignment,
        AssignmentSubmission $submission
    ) {
        Gate::authorize('update', [$submission, $assignment]);
        $users = $assignment->users;
        return view(
            'admin.assignments.submissions.edit',
            compact('assignment', 'submission', 'users')
        );
    }

    public function update(
        Request $request,
        Assignment $assignment,
        AssignmentSubmission $submission
    ) {
        Gate::authorize('update', [$submission, $assignment]);

        $request->validate([
            'description' => 'required|string|max:1000',
            'status' => 'required|string|max:255',
        ]);

        $submission->update([
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.assignments.submissions.show', [$assignment, $submission])
            ->with('success', 'Submission updated successfully');
    }

    public function delete(
        Assignment $assignment,
        AssignmentSubmission $submission
    ) {
        Gate::authorize('delete', [$submission, $assignment]);

        return view(
            'admin.assignments.submissions.delete',
            compact('assignment', 'submission')
        );
    }

    public function destroy(
        Assignment $assignment,
        AssignmentSubmission $submission
    ) {
        Gate::authorize('delete', [$submission, $assignment]);
        $submission->delete();
        return redirect()
            ->route('admin.assignments.submissions.index', $assignment)
            ->with('success', 'Submission deleted successfully');
    }

    public function trash(Assignment $assignment) {
        Gate::authorize('viewTrashed', [
            AssignmentSubmission::class,
            $assignment
        ]);
        $submissions = $assignment->submissions()
            ->onlyTrashed()
            ->with('user')
            ->latest()
            ->get();

        return view(
            'admin.assignments.submissions.trash',
            compact('assignment', 'submissions')
        );
    }

    public function restore(Assignment $assignment, AssignmentSubmission $submission)
    {
        Gate::authorize('restore', [$submission, $assignment]);
        $submission->restore();

        return redirect()
            ->route('admin.assignments.submissions.show', [$assignment, $submission])
            ->with('success', 'Submission restored successfully');
    }
}
