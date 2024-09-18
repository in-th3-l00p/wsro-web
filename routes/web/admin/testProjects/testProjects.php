<?php

use App\Http\Controllers\Admin\TestProjects\TestProjectController;
use Illuminate\Support\Facades\Route;

Route::get("/test-projects/delete/{test_project}", [TestProjectController::class, "delete"])
    ->name("admin.test-projects.delete");
Route::get("/test-projects/trash", [TestProjectController::class, "trash"])
    ->name("admin.test-projects.trash");
Route::put("/test-projects/restore/{test_project}", [TestProjectController::class, "restore"])
    ->withTrashed()
    ->name("admin.test-projects.restore");
Route::resource(
    "test-projects",
    TestProjectController::class,
    ["as" => "admin"]
);

require "testProjectTags.php";
require "testProjectAttachments.php";
require "testProjectModules.php";
