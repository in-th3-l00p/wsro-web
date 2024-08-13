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
            <x-ui.layout.subtitle>
                {{ __("Manage test projects") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <section @class(["max-w-fit" => $testProjects->count() > 0])>
            <x-admin.operations.container class="mb-4">
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

            <div
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-8"
            >
                @forelse($testProjects as $testProject)
                    <x-admin.test-projects.test-project-display
                        :testProject="$testProject"
                    />
                @empty
                    <div class="md:col-span-2 lg:col-span-3 empty-text">
                        {{ __("No test projects found.") }}
                    </div>
                @endforelse
            </div>

            {{ $testProjects->links() }}
        </section>
    </x-admin.container>
@endsection
