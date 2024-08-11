@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Create test project')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [ 'name' => __('Create') ],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Complete the fields related to the test project's data") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.test-projects.store") }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this test project')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="title" class="label w-32">{{ __("Title") }}:</label>
                <input
                    type="text" name="title" id="title"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("title")])
                    placeholder="{{ __("Test project's title") }}"
                    value="{{ old("title") }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-32">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Test project's description") }}"
                >{!! old("description") !!}</textarea>
            </div>

            <input type="hidden" aria-hidden="true" name="visibility" value="draft">

            <button
                type="submit"
                class="btn"
                title="{{ __("Create") }}"
            >
                {{ __("Create") }}
            </button>
        </form>
    </x-admin.container>
@endsection
