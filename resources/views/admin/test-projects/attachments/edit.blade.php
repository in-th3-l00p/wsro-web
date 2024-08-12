@extends("layouts.main")

@push("vite")
    @vite([ "resources/js/admin/test-projects/attachments/create.js" ])
@endpush

@section("content")
    <x-admin.container
        :title="__('Edit attachment')"
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
            [ 'name' => __('Edit') . ' \'\'' . $attachment->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Edit the test project's attachment") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            enctype="multipart/form-data"
            action="{{ route("admin.test-projects.attachments.update", [
                "test_project" => $testProject,
                "attachment" => $attachment
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to upload this attachment')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-32">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Attachment's name") }}"
                    value="{{ $attachment->name }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="file" class="label w-32">{{ __("File") }}:</label>
                <input
                    type="file" name="file" id="file"
                    placeholder="{{ __("Attachment's file") }}"
                    @class(["input bg-white", "ring-2 ring-rose-600" => $errors->has("name")])
                >
            </div>

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
