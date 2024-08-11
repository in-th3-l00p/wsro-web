<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use App\Models\TestProjectTag;
use Illuminate\Http\Request;

class TestProjectTagController extends Controller
{
    public function index(TestProject $testProject) {
    }

    public function create(TestProject $testProject) {
    }

    public function store(TestProject $testProject, Request $request) {
    }

    public function show(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function edit(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function update(
        Request $request,
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }

    public function destroy(
        TestProject $testProject,
        TestProjectTag $testProjectTag
    ) {
    }
}
