<?php


use App\Http\Controllers\Admin\TestProjects\TestProjectTagController;
use Illuminate\Support\Facades\Route;

Route::delete(
    "/test-projects/{test_project}/tags",
    [TestProjectTagController::class, "destroyBatch"]
)
    ->name("admin.test-projects.tags.destroyBatch");
Route::prefix("/test-projects")
    ->resource(
        "tags",
        TestProjectTagController::class,
        ["as" => "admin"]
    )
    ->only([ "index", "show", "edit", "update" ]);
Route::resource(
    "test-projects.tags",
    TestProjectTagController::class,
    ["as" => "admin"]
)
    ->only([ "create", "store", "destroy" ]);
