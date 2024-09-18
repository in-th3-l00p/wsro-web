@extends("layouts.main")

@push("vite")
    @vite([ "resources/scss/components/attachment.scss" ])
@endpush

@section("content")
    <x-layout
        :title="__('Test project') . ' \'\'' . $testProject->title . '\'\''"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('user.test-projects.index'), 'name' => __('Test projects') ],
            [ 'name' => __('Test project') . ' \'\'' . $testProject->title . '\'\'' ],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle class="mb-4">
                {!! $testProject->description !!}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <section class="mb-8">
            <h2 class="section-title">
                {{ __("Tags") }}
            </h2>
            <div x-data="selection">
                <div class="flex flex-wrap gap-2 mb-4">
                    @forelse ($testProject->tags()->get() as $tag)
                        <a
                            href="{{ route("user.tags.show", [
                                "tag" => $tag
                            ]) }}"
                            type="button"
                            class="tag"
                        >
                            {{ $tag->name }}
                        </a>
                    @empty
                        <p class="empty-text w-full">
                            {{ __("There are no tags attached to this test project.") }}
                        </p>
                    @endforelse
                </div>
            </div>
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
                            <ul class="flex flex-wrap gap-4 p-4 bg-gray-100 rounded-md">
                                @forelse ($module->attachments as $attachment)
                                    <div class="attachment-small">
                                        <i class="fa-solid fa-file fa-2xl icon"></i>
                                        <h2 class="title">{{ $attachment->name }}</h2>
                                        <div class="btn-group justify-center">
                                            <a
                                                title="{{ __('Download') }}"
                                                href="{{ route('user.test-projects.attachments.show', [
                                                    'test_project' => $attachment->test_project_id,
                                                    'attachment' => $attachment
                                                ]) }}"
                                                class="icon-btn"
                                            >
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                        </div>
                                    </div>
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

        <x-ui.attachments.attachment-list
            baseRoute="user.test-projects"
            entityName="test_project"
            :entity="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :testProject="$testProject"
            :attachments="$testProject->attachments()->latest()->get()"
            :includeTitle="true"
            :includeIndex="true"
        />
    </x-layout>
@endsection
