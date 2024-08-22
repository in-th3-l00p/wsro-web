<?php

namespace App\Policies;

use App\Models\TestProjects\TestProjectModule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestProjectModulePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, TestProjectModule $module): bool
    {
        return
            $user->role === "admin" ||
            $module->testProject->visibility === "public";
    }

    public function create(User $user): bool
    {
        return $user->role === "admin";
    }

    public function update(User $user, TestProjectModule $module): bool
    {
        return $user->role === "admin";
    }

    public function delete(User $user, TestProjectModule $module): bool
    {
        return $user->role === "admin";
    }

    public function restore(User $user, TestProjectModule $module): bool
    {
        return $user->role === "admin";
    }

    public function forceDelete(User $user, TestProjectModule $module): bool
    {
        return $user->role === "admin";
    }
}
