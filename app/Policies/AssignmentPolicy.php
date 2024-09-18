<?php

namespace App\Policies;

use App\Models\Assignments\Assignment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Assignment $assignment): bool
    {
        return
            $user->role === "admin" ||
            $assignment->users->contains($user);
    }

    public function create(User $user): bool
    {
        return $user->role === "admin";
    }

    public function update(User $user, Assignment $assignment): bool
    {
        return $user->role === "admin";
    }

    public function delete(User $user, Assignment $assignment): bool
    {
        return $user->role === "admin";
    }

    public function restore(User $user, Assignment $assignment)
    {
        if (!$assignment->deleted_at)
            return Response::denyAsNotFound();
        return $user->role === "admin" ?
            Response::allow() :
            Response::deny();
    }

    public function forceDelete(
        User $user,
        Assignment $assignment
    ): bool {
        return false;
    }
}
