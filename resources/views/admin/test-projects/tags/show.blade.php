@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Tag') . ' \'\'' . $tag->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [ 'href' => route('admin.tags.index'), 'name' => __('Tags')],
            [ 'name' => __('Tag') . ' \'\'' . $tag->name . '\'\'' ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("See test projects that are using the tag, or update it's name") }}
            </x-ui.layout.subtitle>

            <x-admin.operations.container>
                <x-admin.operations.route
                    :title="__('Edit tag')"
                    :href="route('admin.tags.edit', [
                        'tag' => $tag
                    ])"
                    icon="fa-pen-to-square"
                />
            </x-admin.operations.container>
        </x-slot:subtitle>

        <h2 class="text-3xl font-bold mb-4">
            {{ __("Test projects") }}
        </h2>
        <section
            @class([
                "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16",
                "max-w-fit" => $tag->testProjects()->count() > 0
            ])
        >
            @forelse ($tag->testProjects()->get() as $testProject)
                <x-ui.test-project
                    :testProject="$testProject"
                >
                    <x-slot:buttons>
                        <form
                            method="post"
                            action="{{ route("admin.test-projects.tags.destroy", [
                                "test_project" => $testProject,
                                "tag" => $tag
                            ]) }}"
                        >
                            @csrf
                            @method("DELETE")

                            <button type="submit" class="btn">
                                <i class="fa-solid fa-trash"></i>
                                Remove
                            </button>
                        </form>
                    </x-slot:buttons>
                </x-ui.test-project>
            @empty
                <div @class([
                    "w-full sm:col-span-2 md:col-span-3 lg:col-span-4",
                    "text-center text-zinc-600 text-lg"
                ])>
                    {{ __("No test projects found.") }}
                </div>
            @endforelse
        </section>
    </x-admin.container>
@endsection
