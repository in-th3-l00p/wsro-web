@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Create module')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [ 'test_project' => $testProject ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Create module') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Add or create a new module") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>
    </x-admin.container>
@endsection
