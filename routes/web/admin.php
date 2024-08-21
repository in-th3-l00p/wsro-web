<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TestProjectAttachmentController;
use App\Http\Controllers\Admin\TestProjectController;
use App\Http\Controllers\Admin\TestProjectTagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\TestProjectModuleController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")
    ->middleware("can:admin")
    ->group(function () {
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
        Route::resource(
            "users",
            UserController::class, ["as" => "admin"]
        );

        // test projects
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

        // test project tags
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
            TestProjectAttachmentController::class,
            ["as" => "admin"]
        );

        // test project modules
        Route::get(
            "/test-projects/{test_project}/modules/{module}/delete",
            [TestProjectModuleController::class, "delete"],
        )
            ->name("admin.test-projects.modules.delete");
        Route::resource(
            "test-projects.modules",
            TestProjectModuleController::class,
            ["as" => "admin"]
        );
    });
