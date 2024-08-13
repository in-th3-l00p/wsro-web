<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class IndexController extends Controller {
    public function __invoke(Request $request) {
        Gate::allowIf($request->user());
        if (!$request->user())
            return redirect()->route("login.form");
        return redirect()->route("user.dashboard");
    }
}
