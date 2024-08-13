@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects') ],
            [ 'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {!! $testProject->description !!}
            </x-ui.layout.subtitle>

            <x-admin.operations.container>
                <x-admin.operations.container>
                    <x-admin.operations.route
                        :title="__('Edit test project')"
                        :href="route('admin.test-projects.edit', [
                        'test_project' => $testProject
                    ])"
                        icon="fa-pen-to-square"
                    />
                    <x-admin.operations.route
                        :title="__('Delete test project')"
                        :href="route('admin.test-projects.delete', [
                        'test_project' => $testProject
                    ])"
                        icon="fa-trash"
                    />
                </x-admin.operations.container>
            </x-admin.operations.container>
        </x-slot:subtitle>

        <section class="mb-8">
            <h2 class="section-title">
                {{ __("Tags") }}
            </h2>
            <div x-data="selection">
                <div class="flex flex-wrap gap-2 mb-4">
                    @foreach ($testProject->tags()->get() as $tag)
                        <button
                            type="button"
                            class="tag"
                            @click="toggle({{ $tag->id }})"
                            x-bind:class="check({{ $tag->id }}) ? 'tag-toggled' : ''"
                        >
                            {{ $tag->name }}
                        </button>
                    @endforeach
                    <a
                        href="{{ route("admin.test-projects.tags.create", [
                                "test_project" => $testProject
                            ]) }}"
                        class="tag !px-8"
                    >
                        <i class="fa-solid fa-plus"></i>
                    </a>
                </div>

                <div
                    x-show="!empty()"
                    class="flex items-center gap-4"
                >
                    <p>
                        <span x-text="selected.length"></span>
                        items selected
                    </p>

                    <form
                        method="post"
                        action="{{ route("admin.test-projects.tags.destroyBatch", [
                            "test_project" => $testProject
                        ]) }}"
                    >
                        @csrf
                        @method("DELETE")

                        <template x-for="id in selected">
                            <input
                                type="hidden" aria-hidden="true"
                                id="tag" name="tags[]"
                                x-bind:value="id"
                            >
                        </template>

                        <button type="submit" class="icon-btn">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- used for tag selection functionality !-->
            <script defer>
                document.addEventListener("alpine:init", () => {
                    Alpine.data("selection", () => ({
                        selected: [],
                        toggle(id) {
                            const index = this.selected.indexOf(id);
                            if (index !== -1) {
                                this.selected.splice(index, 1);
                            } else {
                                this.selected.push(id);
                            }
                        },
                        check(id) {
                            return this.selected.indexOf(id) !== -1;
                        },
                        empty() {
                            return this.selected.length === 0;
                        }
                    }))
                })
            </script>
        </section>

        <x-admin.test-projects.attachments.attachment-list
            :testProject="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :includeTitle="true"
            :includeIndex="true"
        />
    </x-admin.container>
@endsection
