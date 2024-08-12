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

        <div class="max-w-fit">
            <x-admin.operations.container>
                <x-admin.operations.route
                    :title="__('Create test project')"
                    :href="route('admin.test-projects.create')"
                    icon="fa-plus"
                />
                <x-admin.operations.route
                    :title="__('Test project tags')"
                    :href="route('admin.test-projects.tags.index')"
                    icon="fa-tags"
                />
                <x-admin.operations.route
                    :title="__('Test project trash')"
                    :href="route('admin.test-projects.trash')"
                    icon="fa-trash"
                />
            </x-admin.operations.container>

            <section @class([
                "grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16",
                "max-w-fit" => $testProjects->count() > 0,
            ])>
                @forelse($testProjects as $testProject)
                    <x-admin.test-projects.test-project-display
                        :testProject="$testProject"
                    />
                @empty
                    <div @class([
                        "sm:col-span-2 md:col-span-3 lg:col-span-4",
                        "empty-text"
                    ])>
                        {{ __("No test projects found.") }}
                    </div>
                @endforelse
            </section>
        </div>
    </x-admin.container>
@endsection
