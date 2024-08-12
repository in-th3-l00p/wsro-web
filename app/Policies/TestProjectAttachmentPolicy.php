<?php

namespace App\Policies;

use App\Models\TestProjectAttachment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TestProjectAttachmentPolicy {
    public function viewAny(User $user): bool {
        return true;
    }

    public function view(
        User $user,
        TestProjectAttachment $attachment
    ): Response {
        $visibility =
            $attachment
                ->testProject()
                ->get("visiblity")[0];
        if ($visibility !== "public" && $user->role !== "admin")
            return Response::denyAsNotFound();
        return Response::allow();
    }

    public function create(User $user): bool {
        return $user->role === "admin";
    }

    public function update(
        User $user,
        TestProjectAttachment $attachment
    ): bool {
        return $user->role === "admin";
    }

    public function delete(
        User $user,
        TestProjectAttachment $attachment
    ): bool {
        return $user->role === "admin";
    }

    public function restore(
        User $user,
        TestProjectAttachment $attachment
    ): bool {
        return $user->role === "admin";
    }

    public function forceDelete(
        User $user,
        TestProjectAttachment $attachment
    ): bool {
        return $user->role === "admin";
    }
}
