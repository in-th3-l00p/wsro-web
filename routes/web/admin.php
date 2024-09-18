<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix("/admin")
    ->middleware("can:admin")
    ->group(function () {
        Route::get("/dashboard", [AdminController::class, "dashboard"])
            ->name("admin.dashboard");

        require "admin/users.php";
        require "admin/testProjects/testProjects.php";
        require "admin/testProjects/testProjectTags.php";
        require "admin/testProjects/testProjectAttachments.php";
        require "admin/testProjects/testProjectModules.php";
        require "admin/assignments/assignments.php";
    });
