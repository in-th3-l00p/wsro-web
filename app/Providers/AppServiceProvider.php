<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {
        //
    }

    public function boot(): void {
        Paginator::defaultView("vendor.pagination.tailwind");
        Paginator::defaultSimpleView("vendor.pagination.simple-tailwind");

        Gate::define("auth", function (User $user) {
            return true;
        });

        Gate::define("admin", function (User $user) {
            return $user->role === "admin";
        });
    }
}
