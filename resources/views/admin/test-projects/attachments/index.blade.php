@extends("layouts.main")

@section("content")
    <x-layout
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

        <x-ui.attachments.attachment-list
            baseRoute="admin.test-projects"
            entityName="test_project"
            :entity="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :admin="true"
            :testProject="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :includeTitle="true"
            :includeIndex="true"
        />
    </x-layout>
@endsection
