@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test projects')"
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
                'name' => 'Trash'
            ]
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("See all deleted attachments") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <section>
            <div class="flex flex-wrap gap-8">
                @forelse ($attachments as $attachment)
                    <div
                        @class([
                            "bg-white rounded-md shadow-md w-64 aspect-square py-4",
                            "grid grid-rows-4 justify-center items-center",
                            "hover:scale-105 hover:shadow-xl transition-all"
                        ])
                    >
                        <i @class([
                            "fa-solid fa-file fa-2xl",
                            "row-span-2 text-rose-600 mx-auto scale-150"
                        ])></i>
                        <h2 class="text-xl">{{ $attachment->name }}</h2>
                        <x-admin.operations.container class="justify-center">
                            <form
                                method="post"
                                action="{{ route("admin.test-projects.attachments.restore", [
                                    "test_project" => $testProject,
                                    "attachment" => $attachment
                                ]) }}"
                            >
                                @csrf
                                @method("PUT")

                                <button
                                    type="submit"
                                    title="{{ __("Restore attachment") }}"
                                    class="btn"
                                >
                                    Restore
                                </button>
                            </form>
                        </x-admin.operations.container>
                    </div>
                @empty
                    <p class="empty-text">{{ __("There are no attachments") }}</p>
                @endforelse
            </div>
        </section>
    </x-admin.container>
@endsection
