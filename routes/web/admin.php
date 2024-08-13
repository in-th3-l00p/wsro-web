<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TestProjectAttachmentController;
use App\Http\Controllers\Admin\TestProjectController;
use App\Http\Controllers\Admin\TestProjectTagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")->group(function () {
    Route::get("/dashboard", [AdminController::class, "dashboard"])
        ->name("admin.dashboard");

    // users
    Route::get("/users/delete/{user}", [UserController::class, "delete"])
        ->name("admin.users.delete");
    Route::get("/users/trash", [UserController::class, "trash"])
        ->name("admin.users.trash");
    Route::put("/users/restore/{user}", [UserController::class, "restore"])
        ->withTrashed()
        ->name("admin.users.restore");
    Route::resource("users", UserController::class)->names([
        "index" => "admin.users.index",
        "show" => "admin.users.show",
        "create" => "admin.users.create",
        "store" => "admin.users.store",
        "edit" => "admin.users.edit",
        "update" => "admin.users.update",
        "destroy" => "admin.users.destroy",
    ]);

    // test projects
    Route::get("/test-projects/delete/{test_project}", [TestProjectController::class, "delete"])
        ->name("admin.test-projects.delete");
    Route::get("/test-projects/trash", [TestProjectController::class, "trash"])
        ->name("admin.test-projects.trash");
    Route::put("/test-projects/restore/{test_project}", [TestProjectController::class, "restore"])
        ->withTrashed()
        ->name("admin.test-projects.restore");
    Route::resource("test-projects", TestProjectController::class)
        ->names([
            "index" => "admin.test-projects.index",
            "show" => "admin.test-projects.show",
            "create" => "admin.test-projects.create",
            "store" => "admin.test-projects.store",
            "edit" => "admin.test-projects.edit",
            "update" => "admin.test-projects.update",
            "destroy" => "admin.test-projects.destroy",
        ]);

    // test project tags
    Route::delete(
        "/test-projects/{test_project}/tags",
        [TestProjectTagController::class, "destroyBatch"]
    )
        ->name("admin.test-projects.tags.destroyBatch");
    Route::prefix("/test-projects")
        ->resource("tags", TestProjectTagController::class)
        ->only([ "index", "show", "edit", "update" ])
        ->names([
            "index" => "admin.test-projects.tags.index",
            "show" => "admin.test-projects.tags.show",
            "edit" => "admin.test-projects.tags.edit",
            "update" => "admin.test-projects.tags.update",
        ]);
    Route::resource(
        "test-projects.tags",
        TestProjectTagController::class
    )
        ->only([ "create", "store", "destroy" ])
        ->names([
            "create" => "admin.test-projects.tags.create",
            "store" => "admin.test-projects.tags.store",
            "destroy" => "admin.test-projects.tags.destroy"
        ]);

    // test project attachments
    Route::prefix("/test-projects/{test_project}")->group(function () {
        Route::get(
            "/attachments/delete/{attachment}",
            [TestProjectAttachmentController::class, "delete"]
        )
            ->name("admin.test-projects.attachments.delete");
        Route::get(
            "/attachments/trash",
            [TestProjectAttachmentController::class, "trash"]
        )
            ->name("admin.test-projects.attachments.trash");
        Route::put(
            "/attachments/restore/{attachment}",
            [TestProjectAttachmentController::class, "restore"]
        )
            ->withTrashed()
            ->name("admin.test-projects.attachments.restore");
    });
    Route::resource(
        "test-projects.attachments",
        TestProjectAttachmentController::class
    )
        ->names([
            "index" => "admin.test-projects.attachments.index",
            "show" => "admin.test-projects.attachments.show",
            "create" => "admin.test-projects.attachments.create",
            "store" => "admin.test-projects.attachments.store",
            "edit" => "admin.test-projects.attachments.edit",
            "update" => "admin.test-projects.attachments.update",
            "destroy" => "admin.test-projects.attachments.destroy",
        ]);
});
