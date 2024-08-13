<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function dashboard(Request $request) {
        Gate::allowIf(
            $request->user() &&
            $request->user()->role === "admin"
        );
        return view("admin.dashboard");
    }
}
