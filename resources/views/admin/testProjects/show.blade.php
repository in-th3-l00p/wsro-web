@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.testProjects.index'), 'name' => __('Test projects') ],
            [ 'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <div class="mb-4 mt-2">
                {!! $testProject->description !!}
            </div>

            <x-admin.operations.container>
                <x-admin.operations.container>
                    <x-admin.operations.route
                        :title="__('Edit test project')"
                        :href="route('admin.testProjects.edit', [
                        'test_project' => $testProject
                    ])"
                        icon="fa-pen-to-square"
                    />
                    <x-admin.operations.route
                        :title="__('Delete test project')"
                        :href="route('admin.testProjects.delete', [
                        'test_project' => $testProject
                    ])"
                        icon="fa-trash"
                    />
                </x-admin.operations.container>
            </x-admin.operations.container>


        </x-slot:subtitle>
    </x-admin.container>
@endsection
