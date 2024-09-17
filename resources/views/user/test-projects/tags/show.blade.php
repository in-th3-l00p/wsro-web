@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Tag') . ' \'\'' . $tag->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('user.test-projects.index'), 'name' => __('Test projects') ],
            [ 'href' => route('user.tags.index'), 'name' => __('Tags')],
            [ 'name' => __('Tag') . ' \'\'' . $tag->name . '\'\'' ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {{ __("See test projects that are using the tag") }}
            </x-ui.layout.subtitle>
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
                />
            @empty
                <div @class([
                    "w-full sm:col-span-2 md:col-span-3 lg:col-span-4",
                    "text-center text-zinc-600 text-lg"
                ])>
                    {{ __("No test projects found.") }}
                </div>
            @endforelse
        </section>
    </x-layout>
@endsection
