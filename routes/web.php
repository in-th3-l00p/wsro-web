<?php

use App\Http\Controllers\Admin\TestProjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get("/", IndexController::class);

Route::get("/login", [AuthController::class, "loginForm"])
    ->name("login.form");
Route::post("/login", [AuthController::class, "loginSubmit"])
    ->name("login.submit");
Route::get("/logout", [AuthController::class, "logout"])
    ->name("logout");


Route::prefix("/admin")->group(function () {
    Route::get("/dashboard", [AdminController::class, "dashboard"])
        ->name("admin.dashboard");

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

    Route::get("/test-projects/delete/{test_project}", [TestProjectController::class, "delete"])
        ->name("admin.testProjects.delete");
    Route::get("/test-projects/trash", [TestProjectController::class, "trash"])
        ->name("admin.testProjects.trash");
    Route::put("/test-projects/restore/{test_project}", [TestProjectController::class, "restore"])
        ->withTrashed()
        ->name("admin.testProjects.restore");
    Route::resource("test-projects", TestProjectController::class)
        ->names([
            "index" => "admin.testProjects.index",
            "show" => "admin.testProjects.show",
            "create" => "admin.testProjects.create",
            "store" => "admin.testProjects.store",
            "edit" => "admin.testProjects.edit",
            "update" => "admin.testProjects.update",
            "destroy" => "admin.testProjects.destroy",
        ]);
});
