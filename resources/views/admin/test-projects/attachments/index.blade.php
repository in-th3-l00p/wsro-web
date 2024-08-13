@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test projects')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [
                    'test_project' => $testProject
                ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Attachments') ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("See all test project's attachments") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <x-admin.test-projects.attachments.attachment-list
            :testProject="$testProject"
            :attachments="$attachments"
        />
    </x-admin.container>
@endsection
