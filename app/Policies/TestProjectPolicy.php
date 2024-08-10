<?php

namespace App\Policies;

use App\Models\TestProject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestProjectPolicy
{
    public function viewAny(User $user): bool {
        return true;
    }

    public function viewTrashed(User $user): bool {
        return $user->role === "admin";
    }

    public function view(User $user, TestProject $testProject): bool {
        return
            $user->role === "admin" ||
            $testProject->visibility === "public";
    }

    public function create(User $user): bool {
        return $user->role === "admin";
    }

    public function update(User $user, TestProject $testProject): bool {
        return $user->role === "admin";
    }

    public function delete(User $user, TestProject $testProject): bool {
        return $user->role === "admin";
    }

    public function restore(User $user, TestProject $testProject) {
        if (!$testProject->deleted_at)
            return Response::denyAsNotFound();
        return $user->role === "admin" ?
            Response::allow() :
            Response::deny();
    }

    public function forceDelete(User $user, TestProject $testProject): bool {
        return false;
    }
}
