@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Add tag to') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [ 'test_project' => $testProject ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Add tag') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Add or create a new tag") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.test-projects.tags.store", [
                "test_project" => $testProject
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this tag')"
                :errors="$errors"
            />

            <div class="form-group mb-8">
                <label for="name" class="label w-16">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Tag's name") }}"
                    value="{{ old("name") }}"
                    autocomplete="off"
                >
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Add") }}"
            >
                {{ __("Add") }}
            </button>
        </form>
    </x-layout>
@endsection
