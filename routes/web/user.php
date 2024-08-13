<?php

use App\Http\Controllers\User\TestProjectAttachmentController;
use App\Http\Controllers\User\TestProjectController;
use App\Http\Controllers\User\TestProjectTagController;
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

Route::resource(
    "tags",
    TestProjectTagController::class,
    [ "as" => "user" ]
);

Route::resource(
    "test-projects.attachments",
    TestProjectAttachmentController::class,
    [ "as" => "user" ]
);
