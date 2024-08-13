@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Edit test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [
                    'test_project' => $testProject
                ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Edit') ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Complete the fields related to the test project's data") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.test-projects.update", [
                "test_project" => $testProject
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to update this test project')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="title" class="label w-32">{{ __("Title") }}:</label>
                <input
                    type="text" name="title" id="title"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("title")])
                    placeholder="{{ __("Test project's title") }}"
                    value="{{ $testProject->title }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-32">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Test project's description") }}"
                >{!! $testProject->description !!}</textarea>
            </div>

            <input type="hidden" aria-hidden="true" name="visibility" value="draft">

            <button
                type="submit"
                class="btn"
                title="{{ __("Edit") }}"
            >
                {{ __("Edit") }}
            </button>
        </form>
    </x-admin.container>
@endsection
