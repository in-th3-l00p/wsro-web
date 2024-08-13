<?php

use App\Http\Controllers\User\TestProjectController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get("/dashboard", [
    UserController::class,
    "dashboard"
])
    ->name("user.dashboard");

Route::resource(
    "test-projects",
    TestProjectController::class,
    [ "as" => "user" ]
);
