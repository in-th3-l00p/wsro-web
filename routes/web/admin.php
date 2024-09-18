<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")
    ->middleware("can:admin")
    ->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])
            ->name("admin.dashboard");

        require "admin/users.php";
        require "admin/testProjects.php";
        require "admin/testProjectTags.php";
        require "admin/testProjectAttachments.php";
        require "admin/testProjectModules.php";
    });
