@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Assignment') . ' \'\'' . $assignment->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.assignments.index'), 'name' => __('Assignment') ],
            [ 'name' => __('Assignment') . ' \'\'' . $assignment->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {!! $assignment->description !!}
            </x-ui.layout.subtitle>

            <x-admin.operations.container>
                <x-admin.operations.container>
                    <x-admin.operations.route
                        :title="__('Edit assignment')"
                        :href="route('admin.assignments.edit', [
                        'assignment' => $assignment
                    ])"
                        icon="fa-pen-to-square"
                    />
                    <x-admin.operations.route
                        :title="__('Delete assignment')"
                        :href="route('admin.assignments.delete', [
                            'assignment' => $assignment
                        ])"
                        icon="fa-trash"
                    />
                </x-admin.operations.container>
            </x-admin.operations.container>
        </x-slot:subtitle>

        <x-ui.attachments.attachment-list
            baseRoute="admin.assignments"
            entityName="assignment"
            :entity="$assignment"
            :attachments="$assignment->attachments()->latest()->get()"
            :testProject="$assignment"
            :attachments="$assignment->attachments()->latest()->get()"
            :includeTitle="true"
            :includeIndex="true"
            :admin="true"
        />
    </x-layout>
@endsection
