@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Delete test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.users.index'), 'name' => __('Users') ],
            [ 'name' => __('Delete') . ' \'\'' . $testProject->title . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Are you sure you want to delete test project") }}: {{ $testProject->title }}?
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            method="post"
            action="{{ route("admin.testProjects.destroy", [
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
