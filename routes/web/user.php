<?php

use App\Http\Controllers\User\TestProject\TestProjectAttachmentController;
use App\Http\Controllers\User\TestProject\TestProjectController;
use App\Http\Controllers\User\TestProject\TestProjectTagController;
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
)
    ->only([ "index", "show" ]);

Route::resource(
    "tags",
    TestProjectTagController::class,
    [ "as" => "user" ]
)
    ->only([ "index", "show" ]);

Route::resource(
    "test-projects.attachments",
    TestProjectAttachmentController::class,
    [ "as" => "user" ]
)
    ->only([ "show" ]);
