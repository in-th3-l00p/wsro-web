@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Delete test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [
                    'test_project' => $testProject
                ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Delete') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Are you sure you want to delete test project") }}: ''{{ $testProject->title }}''?
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.test-projects.destroy", [
                "test_project" => $testProject
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
