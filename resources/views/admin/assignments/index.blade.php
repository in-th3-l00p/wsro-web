@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Assignments')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'name' => __('Assignments')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Manage assignments") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div>
            <x-admin.operations.container class="mb-4">
                <x-admin.operations.route
                    :title="__('Create assignment')"
                    :href="route('admin.assignments.create')"
                    icon="fa-plus"
                />
                <x-admin.operations.route
                    :title="__('Assignments trash')"
                    :href="route('admin.assignments.trash')"
                    icon="fa-trash"
                />
            </x-admin.operations.container>

            <section
                class="space-y-8 mb-8 max-w-4xl"
            >
                @forelse($assignments as $assignment)
                    <a
                        href="{{ route("admin.assignments.show", [
                            "assignment" => $assignment
                        ]) }}"
                        @class([
                            "flex items-center justify-between",
                            "bg-white rounded-md shadow-md p-8",
                            "hover:shadow-lg hover:scale-105 transition-all",
                        ])
                    >
                        <div>
                            <h2
                                class="text-lg font-semibold leading-6 text-gray-900"
                            >
                                {{ $assignment->name }}
                            </h2>
                            <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                                <p>{{ $assignment->owner->name }}</p>
                                <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                    <circle cx="1" cy="1" r="1" />
                                </svg>
                                <p>
                                    <time datetime="{{ $assignment->created_at }}">
                                        {{ (new \Carbon\Carbon($assignment->created_at))->diffForHumans() }}
                                    </time>
                                </p>
                            </div>
                        </div>

                        @if ($assignment->deadline)
                            <div>
                                <p class="text-sm">Deadline:</p>
                                <p>
                                    <time datetime="{{ $assignment->deadline }}">
                                        {{ (new \Carbon\Carbon($assignment->deadline))->diffForHumans() }}
                                    </time>
                                </p>
                            </div>
                        @endif
                    </a>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 empty-text">
                        {{ __("No assignments found.") }}
                    </div>
                @endforelse

                {{ $assignments->links() }}
            </section>
        </div>
    </x-layout>
@endsection
