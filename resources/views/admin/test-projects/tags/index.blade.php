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
            <x-admin.container-subtitle>
                {{ __("Manage test project tags") }}
            </x-admin.container-subtitle>
        </x-slot:subtitle>

        <div>
            <section @class([ "flex flex-wrap gap-4" ])>
                @forelse($tags as $tag)
                    <a
                        class="tag"
                        href="{{ route("admin.test-projects.tags.show", [
                            "tag" => $tag
                        ]) }}"
                    >
                        {{ $tag->name }}
                    </a>
                @empty
                    <div @class([ "w-full text-center text-zinc-600 text-lg" ])>
                        {{ __("No tags found.") }}
                    </div>
                @endforelse
            </section>
        </div>
    </x-admin.container>
@endsection
