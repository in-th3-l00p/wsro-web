<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestProject;
use App\Models\TestProjectTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class TestProjectTagController extends Controller
{
    public function index() {
        Gate::authorize("viewAny", TestProjectTag::class);
        return view("admin.test-projects.tags.index", [
            "tags" => TestProjectTag::all()
        ]);
    }

    public function create(TestProject $testProject) {
        Gate::authorize("create", TestProjectTag::class);
        return view("admin.test-projects.tags.create", [
            "testProject" => $testProject
        ]);
    }

    public function store(
        TestProject $testProject,
        Request $request
    ) {
        Gate::authorize("create", TestProjectTag::class);
        $request->validate([
            "name" => "required|max:255"
        ]);
        $tag = TestProjectTag::query()
            ->where("name", "=", $request->name)
            ->first();
        if (!$tag)
            $tag = TestProjectTag::create([
                "name" => $request->name
            ]);
        $testProject->tags()->attach($tag);
        return redirect()
            ->route("admin.test-projects.show", [
                "test_project" => $testProject
            ])
            ->with([ "success" => __("Tag added!") ]);

    }

    public function show(TestProjectTag $tag) {
        Gate::authorize("view", $tag);
        return view("admin.test-projects.tags.show", [
            "tag" => $tag
        ]);
    }

    public function edit(TestProjectTag $tag) {
        Gate::authorize("update", $tag);
        return view("admin.test-projects.tags.edit", [
            "tag" => $tag
        ]);
    }

    public function update(
        Request $request,
        TestProjectTag $tag
    ) {
        Gate::authorize("update", $tag);
        $body = $request->validate([
            "name" => "required|max:255"
        ]);
        $tag->update($body);
        return redirect()
            ->route("admin.test-projects.tags.show", ["tag" => $tag])
            ->with([
                "success" => __("Tag updated successfully!")
            ]);
    }

    public function destroy(
        TestProject $testProject,
        TestProjectTag $tag
    ) {
        Gate::authorize("delete", $tag);
        $testProject->tags()->detach($tag);
        if ($tag->testProjects()->count() === 0) {
            $tag->delete();
            return redirect()
                ->route("admin.test-projects.tags.index")
                ->with([
                    "success" => __("Tag removed!"),
                    "info" => __("You were redirect as there were no more test projects associated with that tag.")
                ]);
        }

        return redirect()
            ->back()
            ->with([ "success" => __("Tag removed!") ]);
    }

    public function destroyBatch(
        Request $request,
        TestProject $testProject
    ) {
        $tags = collect([]);
        foreach ($request->tags as $tagId)
            $tags->push(TestProjectTag::findOrFail($tagId));
        $testProject->tags()->detach($request->tags);
        foreach ($tags as $tag)
            if ($tag->testProjects()->count() === 0)
                $tag->delete();

        $message = "Tag";
        if (sizeof($request->tags) > 1)
            $message = Str::plural($message);
        $message = $message . " removed!";
        return back()->with([
            "success" => __($message)
        ]);
    }

}
