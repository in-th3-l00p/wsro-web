@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test projects trash')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.testProjects.index'), 'name' => __('Test projects') ],
            [ 'name' => __('Test projects trash')],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("See and restore deleted test projects") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <section @class([
            "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4",
            "gap-16",
        ])>
            @forelse($testProjects as $testProject)
                <x-admin.test-projects.trashed-test-project-display
                    :testProject="$testProject"
                />
            @empty
                <div @class([
                    "sm:col-span-2 md:col-span-3 lg:col-span-4",
                    "text-center text-zinc-600 text-lg"
                ])>
                    {{ __("No test projects found.") }}
                </div>
            @endforelse
        </section>
    </x-admin.container>
@endsection
