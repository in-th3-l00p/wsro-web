<?php

namespace App\Policies;

use App\Models\TestProjects\TestProjectTag;
use App\Models\User;

class TestProjectTagPolicy {
    public function viewAny(User $user): bool {
        return true;
    }

    public function view(
        User $user,
        TestProjectTag $testProjectTag
    ): bool {
        return true;
    }

    public function create(User $user): bool {
        return $user->role === "admin";
    }

    public function update(
        User $user,
        TestProjectTag $testProjectTag
    ): bool {
        return $user->role === "admin";
    }

    public function delete(
        User $user,
        TestProjectTag $testProjectTag
    ): bool {
        return $user->role === "admin";
    }

    public function restore(
        User $user,
        TestProjectTag $testProjectTag
    ): bool {
        return $user->role === "admin";
    }

    public function forceDelete(
        User $user,
        TestProjectTag $testProjectTag
    ): bool {
        return $user->role === "admin";
    }
}
