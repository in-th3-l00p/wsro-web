<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TestProjects\TestProjectTag;
use Illuminate\Support\Facades\Gate;

class TestProjectTagController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProjectTag::class);
        return view("user.test-projects.tags.index", [
            "tags" => TestProjectTag::all()
        ]);
    }

    public function show(TestProjectTag $tag) {
        Gate::authorize("view", $tag);
        return view("user.test-projects.tags.show", [
            "tag" => $tag
        ]);
    }
}
