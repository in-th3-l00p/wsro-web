<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        return view("admin.users", [
            "users" => User::query()
                ->orderBy("role")
                ->orderBy("id")
                ->cursorPaginate(10)
        ]);
    }
}
