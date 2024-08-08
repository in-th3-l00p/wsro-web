<?php

namespace App\Http\Controllers;

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

    public function users(Request $request) {
        Gate::allowIf(
            $request->user() &&
            $request->user()->role === "admin"
        );
        return view("admin.users");
    }
}
