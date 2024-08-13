<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use App\Models\TestProjectAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TestProjectAttachmentController extends Controller {
    public function show(
        TestProject $testProject,
        TestProjectAttachment $attachment
    ) {
        Gate::authorize("view", $attachment);
        return Storage::download(
            $attachment->path,
            $attachment->name
        );
    }
}
