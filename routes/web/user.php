<?php

use App\Http\Controllers\User\TestProjects\TestProjectAttachmentController;
use App\Http\Controllers\User\TestProjects\TestProjectController;
use App\Http\Controllers\User\TestProjects\TestProjectTagController;
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
