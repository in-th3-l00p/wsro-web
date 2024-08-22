@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Delete module') . ' \'\'' . $module->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [ 'test_project' => $testProject ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Delete module') . ' \'\'' . $module->title . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Are you sure you want to delete module") }}: ''{{ $module->name }}''?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.test-projects.modules.destroy", [
                "test_project" => $testProject,
                "module" => $module
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
