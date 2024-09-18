<?php

namespace App\Policies;

use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentSubmission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentSubmissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(
        User $user,
        Assignment $assignment
    ) {
        return $user->role === "admin" ||
            $user->id === $assignment->owner_id;
    }

    public function view(
        User $user,
        AssignmentSubmission $submission,
        Assignment $assignment
    ) {
        if ($submission->assignment_id !== $assignment->id) {
            return false;
        }
        return $user->role === "admin" ||
            $user->id === $assignment->owner_id ||
            $user->id === $submission->user_id;
    }

    public function create(
        User $user,
        Assignment $assignment
    ) {
        return $user->role === "admin" ||
            $assignment->users()
                ->where('users.id', $user->id)
                ->exists();
    }

    public function update(
        User $user,
        AssignmentSubmission $submission,
        Assignment $assignment
    ) {
        if ($submission->assignment_id !== $assignment->id) {
            return false;
        }
        return $user->role === "admin" ||
            $user->id === $submission->user_id;
    }

    public function delete(
        User $user,
        AssignmentSubmission $submission,
        Assignment $assignment
    ) {
        if ($submission->assignment_id !== $assignment->id) {
            return false;
        }
        return $user->role === "admin" ||
            $user->id === $assignment->owner_id;
    }

    public function restore(
        User $user,
        AssignmentSubmission $submission,
        Assignment $assignment
    ) {
        if ($submission->assignment_id !== $assignment->id) {
            return false;
        }

        $existingSubmission = AssignmentSubmission
            ::where('assignment_id', $assignment->id)
            ->where('user_id', $submission->user_id)
            ->whereNull('deleted_at') // Only consider active submissions
            ->exists();

        if ($existingSubmission) {
            return $this->deny(
                __('Cannot restore the submission because the user has already created another submission for this assignment.')
            );
        }

        return
            $submission->deleted_at !== null &&
            (
                $user->role === "admin" ||
                $user->id === $assignment->owner_id
            );
    }

    public function forceDelete(
        User $user,
        AssignmentSubmission $submission,
        Assignment $assignment
    ) {
        return false;
    }
}
