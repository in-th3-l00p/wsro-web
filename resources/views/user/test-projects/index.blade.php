@extends("layouts.main")

@section("content")
    <x-user.layout
        :title="__('Test projects')"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Test projects')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Select a test project") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div @class(["max-w-fit" => $testProjects->count() > 0])>
            <section
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 mb-8"
            >
                @forelse($testProjects as $testProject)
                    <x-ui.test-project
                        :testProject="$testProject"
                    />
                @empty
                    <div class="md:col-span-2 lg:col-span-3 empty-text">
                        {{ __("No test projects found.") }}
                    </div>
                @endforelse
            </section>

            {{ $testProjects->links() }}
        </div>
    </x-user.layout>
@endsection
