@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Delete attachment') . ' \'\'' . $attachment->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [
                    'test_project' => $testProject
                ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [
                'href' => route('admin.test-projects.attachments.index', [
                    'test_project' => $testProject
                ]),
                'name' => __('Attachments')
            ],
            [ 'name' => __('Delete') . ' \'\'' . $attachment->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Are you sure you want to delete attachment") }}: ''{{ $attachment->name }}''?
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.test-projects.attachments.destroy", [
                "test_project" => $testProject,
                "attachment" => $attachment
            ]) }}"
        >
            @csrf
            @method("DELETE")

            <div class="flex gap-4">
                <button type="submit" class="btn">
                    {{ __("Yes") }}
                </button>

                <a href="{{ url()->previous() }}" class="btn">
                    {{ __("No") }}
                </a>
            </div>
        </form>
    </x-admin.container>
@endsection
