@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test projects')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Test projects')],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Manage test projects") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <x-admin.operations.container>
            <x-admin.operations.route
                :title="__('Create test project')"
                :href="route('admin.testProjects.create')"
                icon="fa-plus"
            />
            <x-admin.operations.route
                :title="__('Test project trash')"
                :href="route('admin.testProjects.trash')"
                icon="fa-trash"
            />
        </x-admin.operations.container>

        <section @class([
            "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3",
            "gap-16 max-w-fit mx-auto",
        ])>
            @forelse($testProjects as $testProject)
                <x-admin.test-projects.test-project-display
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
