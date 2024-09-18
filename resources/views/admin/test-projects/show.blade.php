@extends("layouts.main")

@section("content")
    <x-layout
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
            @if ($testProject->visibility === "private")
                <p class="font-semibold mb-4">{{ __("Private") }}</p>
            @endif

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

        <section class="mb-16">
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

        <section class="mb-16">
            <h2 class="section-title">
                {{ __("Modules") }}
            </h2>

            <x-admin.operations.container class="mb-4">
                <x-admin.operations.route
                    :title="__('Create module')"
                    :href="route('admin.test-projects.modules.create', [
                        'test_project' => $testProject
                    ])"
                    icon="fa-plus"
                />
            </x-admin.operations.container>
            <ul role="list" class="divide-y divide-gray-100 bg-white shadow-md rounded-md">
                @forelse($testProject->modules as $module)
                    <li x-data="{ open: false }" class="py-4 px-8 flex flex-col gap-4">
                        <div
                            class="relative flex justify-between gap-x-6"
                            @click="open = !open"
                        >
                            <div class="flex min-w-0 gap-x-4 hover:cursor-pointer">
                                <div @class([
                                    "h-12 w-12 rounded-full bg-rose-600 text-white",
                                    "flex-none flex justify-center items-center",
                                    "font-bold"
                                ])>
                                    @foreach (explode(" ", $module->name) as $word)
                                        <span>{{ ucfirst($word[0]) }}</span>
                                    @endforeach
                                </div>
                                <div class="min-w-0 flex-auto flex my-auto">
                                    <p class="leading-6 text-gray-900">
                                        <span class="absolute inset-x-0 -top-px bottom-0"></span>
                                        {{ $module->name }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex shrink-0 items-center gap-x-4">
                                <svg
                                    class="h-5 w-5 flex-none text-gray-400 transition-all"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                    x-bind:class="open ? 'transform rotate-90' : ''"
                                >
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </div>

                        <div class="w-full" x-show="open">
                            <p class="text-sm pb-4 border-b mb-4">{{ $module->description }}</p>
                            <x-admin.operations.container class="mb-4">
                                <x-admin.operations.route
                                    :title="__('Edit module')"
                                    :href="route('admin.test-projects.modules.edit', [
                                        'test_project' => $testProject,
                                        'module' => $module
                                    ])"
                                    icon="fa-pen-to-square"
                                />
                                <x-admin.operations.route
                                    :title="__('Delete module')"
                                    :href="route('admin.test-projects.modules.delete', [
                                        'test_project' => $testProject,
                                        'module' => $module
                                    ])"
                                    icon="fa-trash"
                                />
                            </x-admin.operations.container>
                            <ul class="flex flex-wrap gap-4 p-4 bg-gray-100 rounded-md">
                                @forelse ($module->attachments as $attachment)
                                    <x-admin.test-projects.attachments.module-attachment
                                        :module="$module"
                                        :attachment="$attachment"
                                    />
                                @empty
                                    <li class="empty-text w-full h-48 flex justify-center items-center">
                                        {{ __("There are no attachments for this module") }}
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </li>
                @empty
                    <li class="empty-text p-8">{{ __("There are no modules") }}</li>
                @endforelse
            </ul>
        </section>

        <x-admin.test-projects.attachments.attachment-list
            :testProject="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :includeTitle="true"
            :includeIndex="true"
        />
    </x-layout>
@endsection
