<?php

use App\Http\Controllers\Admin\TestProject\TestProjectModuleController;
use Illuminate\Support\Facades\Route;

Route::get(
    "/test-projects/{test_project}/modules/{module}/delete",
    [TestProjectModuleController::class, "delete"],
)
    ->name("admin.test-projects.modules.delete");
Route::resource(
    "test-projects.modules",
    TestProjectModuleController::class,
    ["as" => "admin"]
)
    ->only([ "create", "store", "edit", "update", "destroy" ]);
