<?php

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
});
