<?php

namespace App\Http\Controllers\Admin\Assignments;

use App\Http\Controllers\Controller;
use App\Models\Assignments\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    public function index()
    {
        Gate::authorize("viewAny", Assignment::class);
        return view("admin.assignments.index", [
            "assignments" => Assignment::query()
                ->orderBy("deadline")
                ->paginate()
        ]);
    }

    public function create()
    {
        Gate::authorize("create", Assignment::class);
        return view("admin.assignments.create");
    }

    public function store(Request $request)
    {
        Gate::authorize("create", Assignment::class);
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:1000",
            "deadline" => "required|date",
            "users" => "required|array",
            "users.*" => "exists:users,id"
        ]);
        $assignment = Assignment::create([
            "name" => $request->name,
            "description" => $request->description,
            "deadline" => $request->deadline,
            "owner_id" => auth()->id()
        ]);
        $assignment->users()->attach($request->users);

        return redirect()
            ->route("admin.assignments.show", [
                "assignment" => $assignment
            ])
            ->with("success", "Assignment created successfully");
    }

    public function show(Assignment $assignment)
    {
        Gate::authorize("view", $assignment);
        return view("admin.assignments.show", [
            "assignment" => $assignment
        ]);
    }

    public function edit(Assignment $assignment)
    {
        Gate::authorize("update", $assignment);
        return view("admin.assignments.edit", [
            "assignment" => $assignment
        ]);
    }

    public function update(Request $request, Assignment $assignment)
    {
        Gate::authorize("update", $assignment);
        $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string|max:1000",
            "deadline" => "required|date",
            "users" => "required|array",
            "users.*" => "exists:users,id"
        ]);
        $assignment->update([
            "name" => $request->name,
            "description" => $request->description,
            "deadline" => $request->deadline,
        ]);
        $assignment->users()->sync($request->users);

        return redirect()
            ->route("admin.assignments.show", [
                "assignment" => $assignment
            ])
            ->with("success", "Assignment updated successfully");
    }

    public function delete(Assignment $assignment)
    {
        Gate::authorize("delete", $assignment);
        return view("admin.assignments.delete", [
            "assignment" => $assignment
        ]);
    }

    public function destroy(Assignment $assignment)
    {
        Gate::authorize("delete", $assignment);
        $assignment->delete();

        return redirect()
            ->route("admin.assignments.index")
            ->with("success", "Assignment deleted successfully");
    }

    public function trash()
    {
        Gate::authorize("viewTrashed", Assignment::class);
        return view("admin.assignments.trash", [
            "assignments" => Assignment::onlyTrashed()->latest()->get()
        ]);
    }

    public function restore(Assignment $assignment)
    {
        Gate::authorize("restore", $assignment);
        $assignment->restore();
        return redirect()
            ->route("admin.assignments.show", [
                "assignment" => $assignment
            ])
            ->with("success", "Assignment restored successfully");
    }
}
