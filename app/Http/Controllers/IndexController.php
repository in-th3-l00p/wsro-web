<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller {
    public function __invoke(Request $request) {
        if (!$request->user())
            return redirect()->route("login.form");
        return redirect()->route("admin.dashboard");
    }
}
