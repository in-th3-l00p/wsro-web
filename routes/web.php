<?php

use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

Route::get("/", IndexController::class)
    ->name("index");

require __DIR__ . "/web/account.php";
require __DIR__ . "/web/auth.php";
require __DIR__ . "/web/user.php";
require __DIR__ . "/web/admin.php";
