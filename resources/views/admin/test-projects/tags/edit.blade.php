@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Edit tag') . ' \'\'' . $tag->name . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [ 'href' => route('admin.test-projects.tags.index'), 'name' => __('Tags')],
            [
                'href' => route('admin.test-projects.tags.show', [ 'tag' => $tag ]),
                'name' => __('Tag') . ' \'\'' . $tag->name . '\'\''
            ],
            [ 'name' => __('Edit') ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Add or create a new tag") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <form
            action="{{ route("admin.test-projects.tags.update", [
                "tag" => $tag
            ]) }}"
            method="post"
            class="max-w-xl"
        >
            @csrf
            @method("PUT")

            <x-admin.errors-alert
                :text="__('The following errors occurred when trying to update this tag')"
                :errors="$errors"
            />

            <div class="form-group mb-8">
                <label for="name" class="label w-16">{{ __("Name") }}:</label>
                <input
                    type="text" name="name" id="name"
                    @class(["input", "ring-2 ring-rose-600" => $errors->has("name")])
                    placeholder="{{ __("Tag's name") }}"
                    value="{{ $tag->name }}"
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
    </x-admin.container>
@endsection
