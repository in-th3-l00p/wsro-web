<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {
        //
    }

    public function boot(): void {
        Paginator::defaultView("vendor.pagination.tailwind");
        Paginator::defaultSimpleView("vendor.pagination.simple-tailwind");
    }
}
