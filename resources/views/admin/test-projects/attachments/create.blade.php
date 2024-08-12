@extends("layouts.main")

@push("vite")
    @vite([ "resources/js/admin/test-projects/attachments/create.js" ])
@endpush

@section("content")
    <x-admin.container
        :title="__('Add attachment')"
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
            [
                'name' => 'Create'
            ]
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Upload a file to the test project") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <form
            enctype="multipart/form-data"
            action="{{ route("admin.test-projects.attachments.store", [
                "test_project" => $testProject
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf

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
                    value="{{ old("name") }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="file" class="label w-32">{{ __("File") }}:</label>
                <input
                    type="file" name="file" id="file"
                    placeholder="{{ __("Attachment's file") }}"
                    value="{{ old("file") }}"
                    @class(["input bg-white", "ring-2 ring-rose-600" => $errors->has("name")])
                >
            </div>

            <button
                type="submit"
                class="btn"
                title="{{ __("Upload") }}"
            >
                {{ __("Upload") }}
            </button>
        </form>
    </x-admin.container>
@endsection
