<?php

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
    Route::get("/users", [AdminController::class, "users"])
        ->name("admin.users");
});
