@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Test projects')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Test projects')],
        ]"
    >
        <x-slot:subtitle>
            <x-admin.container-subtitle>
                {{ __("Manage test projects") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <section @class([
            "grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4",
            "gap-16",
        ])>
            @forelse($testProjects as $testProject)
                <div
                    type="button"
                    @class([
                        "bg-white p-8 rounded-md shadow-md h-96 flex flex-col",
                        "hover:scale-105 hover:shadow-lg transition-all"
                    ])
                >
                    <h2 class="text-xl font-bold mb-4">{{ $testProject->title }}</h2>
                    <div class="mb-auto">{!! $testProject->description !!}</div>

                    <div class="flex gap-4">
                        <a
                            title="{{ __("See test project") }}"
                            href="{{ route("admin.testProjects.show", [ "test_project" => $testProject ]) }}"
                            class="icon-btn"
                        >
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a
                            title="{{ __("Edit test project") }}"
                            href="{{ route("admin.testProjects.edit", [ "test_project" => $testProject ]) }}"
                            class="icon-btn"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>

                        <a
                            title="{{ __("Delete test project") }}"
                            href="{{ route("admin.testProjects.edit", [ "test_project" => $testProject ]) }}"
                            class="icon-btn"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            @empty
                <div @class([
                    "sm:col-span-2 md:col-span-3 lg:col-span-4",
                    "text-center text-zinc-600 text-lg"
                ])>
                    {{ __("No test projects found.") }}
                </div>
            @endforelse
        </section>
    </x-admin.container>
@endsection
