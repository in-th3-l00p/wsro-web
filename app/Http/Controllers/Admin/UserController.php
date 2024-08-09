<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
            foreach ($request->roles as $role)
                $users->orWhere("role", "=", $role);
        }

        return view("admin.users", [
            "users" => $users
                ->paginate(10)
                ->withQueryString()
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
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
