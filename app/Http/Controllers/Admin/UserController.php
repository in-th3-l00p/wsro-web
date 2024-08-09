<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request) {
        Gate::allowIf(
            $request->user() &&
            $request->user()->role === "admin"
        );

        $request->validate([
            "search_name" => "nullable|max:255",
            "search_email" => "nullable|max:255",
        ]);

        $users = User::query()
            ->orderBy("role")
            ->orderBy("id");

        if ($request->search_name)
            $users->where("name", "like", "%" . $request->search_name . "%");
        if ($request->search_email)
            $users->where("email", "like", "%" . $request->search_email . "%");
        if ($request->roles !== null) {
            $users->where("role", "=", $request->roles[0]);
            for ($i = 1; $i < sizeof($request->roles); $i++)
                $users->orWhere("role", "=", $request->roles[$i]);
        }

        return view("admin.users.index", [
            "users" => $users
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function create(Request $request) {
        Gate::allowIf(
            $request->user() &&
            $request->user()->role === "admin"
        );

        return view("admin.users.create");
    }

    public function store(Request $request) {
        Gate::allowIf(
            $request->user() &&
            $request->user()->role === "admin"
        );
        $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|min:8|max:255",
            "role" => "required|in:user,admin"
        ]);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "role" => $request->role
        ]);

        return redirect()
            ->route("admin.users.show", [ "user" => $user ])
            ->with([ "success" => "User created!" ]);
    }

    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
