<?php

namespace App\Http\Controllers\Admin\Assignments;

use App\Http\Controllers\Controller;
use App\Models\Assignments\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAny", Assignment::class);
        return view("user.assignments.index", [
            "assignments" => Auth::user()
                ->assignments()
                ->orderBy("deadline")
                ->get()
        ]);
    }

    public function show(Assignment $assignment)
    {
        Gate::authorize("view", $assignment);
        return view("user.assignments.show", [
            "assignment" => $assignment
        ]);
    }
}
