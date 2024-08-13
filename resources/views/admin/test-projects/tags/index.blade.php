@extends("layouts.main")

@section("content")
    <x-admin.container
        :title="__('Tags')"
        :breadcrumbPath="[
            [ 'href' => route('admin.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('admin.test-projects.index'), 'name' => __('Test projects')],
            [ 'name' => __('Tags')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("Manage test project tags") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div>
            <section @class([ "flex flex-wrap gap-4" ])>
                @forelse($tags as $tag)
                    <a
                        class="tag"
                        href="{{ route("admin.tags.show", [
                            "tag" => $tag
                        ]) }}"
                    >
                        {{ $tag->name }}
                    </a>
                @empty
                    <div class="w-full empty-text">
                        {{ __("No tags found.") }}
                    </div>
                @endforelse
            </section>
        </div>
    </x-admin.container>
@endsection
