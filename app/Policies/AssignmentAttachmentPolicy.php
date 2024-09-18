<?php

namespace App\Policies;

use App\Models\Assignments\Assignment;
use App\Models\Assignments\AssignmentAttachment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssignmentAttachmentPolicy
{
    use HandlesAuthorization;

    public function viewAny(
        User $user,
        Assignment $assignment
    ) {
        return
            $user->role === 'admin' ||
            $user->id === $assignment->owner_id;
    }

    public function view(
        User $user,
        AssignmentAttachment $attachment
    ) {
        $assignment = $attachment->assignment;

        if ($attachment->assignment_id !== $assignment->id) {
            return false;
        }

        return
            $user->role === 'admin'
            || $user->id === $assignment->owner_id
            || $assignment
                ->users()
                ->where('users.id', $user->id)
                ->exists();
    }

    public function create(
        User $user,
        Assignment $assignment
    ) {
        return
            $user->role === 'admin' ||
            $user->id === $assignment->owner_id;
    }

    public function update(
        User $user,
        AssignmentAttachment $attachment
    ) {
        $assignment = $attachment->assignment;

        if ($attachment->assignment_id !== $assignment->id)
            return false;

        return
            $user->role === 'admin' ||
            $user->id === $assignment->owner_id;
    }

    public function delete(
        User $user,
        AssignmentAttachment $attachment
    ) {
        $assignment = $attachment->assignment;

        if ($attachment->assignment_id !== $assignment->id)
            return false;

        return
            $user->role === 'admin' ||
            $user->id === $assignment->owner_id;
    }

    public function restore(
        User $user,
        AssignmentAttachment $attachment
    ) {
        $assignment = $attachment->assignment;
        if ($attachment->assignment_id !== $assignment->id)
            return false;

        return
            $assignment->deleted_at !== null &&
            (
                $user->role === 'admin' ||
                $user->id === $assignment->owner_id
            );
    }

    public function forceDelete(
        User $user,
        AssignmentAttachment $attachment
    ) {
        $assignment = $attachment->assignment;

        if ($attachment->assignment_id !== $assignment->id)
            return false;

        return $user->role === 'admin';
    }
}
