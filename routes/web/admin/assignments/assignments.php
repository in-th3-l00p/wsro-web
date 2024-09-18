<?php

use App\Http\Controllers\Admin\Assignments\AssignmentController;
use Illuminate\Support\Facades\Route;

Route::get("/assignments/delete/{assignment}", [AssignmentController::class, "delete"])
    ->name("admin.assignments.delete");
Route::get("/assignments/trash", [AssignmentController::class, "trash"])
    ->name("admin.assignments.trash");
Route::put("/assignments/restore/{assignment}", [AssignmentController::class, "restore"])
    ->withTrashed()
    ->name("admin.assignments.restore");
Route::resource(
    "assignments",
    AssignmentController::class,
    ["as" => "admin"]
);

require "assignmentSubmissions.php";
