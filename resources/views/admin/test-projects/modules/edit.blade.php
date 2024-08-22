@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Edit module')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [
                'href' => route('admin.test-projects.show', [ 'test_project' => $testProject ]),
                'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\''
            ],
            [ 'name' => __('Edit module') . ' \'\'' . $module->name . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Edit the selected module") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.test-projects.modules.update", [
                "test_project" => $testProject,
                "module" => $module
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("put")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to create this test project')"
                :errors="$errors"
            />

            <div class="form-group mb-4">
                <label for="name" class="label w-48">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Module's name") }}"
                    value="{{ $module->name }}"
                >
            </div>

            <div class="form-group mb-8">
                <label for="description" class="label w-48">{{ __("Description") }}:</label>
                <textarea
                    name="description" id="description" class="input"
                    placeholder="{{ __("Test project's description") }}"
                >{!! $module->description !!}</textarea>
            </div>

            <div class="form-group mb-8">
                <label for="attachments[]" class="label w-48">{{ __("Attachments") }}:</label>
                @forelse($testProject->attachments as $attachment)
                    <div>
                        <input
                            type="checkbox"
                            id="attachment-{{ $attachment->id }}"
                            name="attachments[]"
                            value="{{ $attachment->id }}"
                            @checked($module->attachments->contains($attachment))
                        >
                        <label for="attachment-{{ $attachment->id }}">
                            {{ $attachment->name }}
                        </label>
                    </div>
                @empty
                    <p class="empty-text">{{ __("The test project has no attachments") }}</p>
                @endforelse
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
