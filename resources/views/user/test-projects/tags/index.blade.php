@extends("layouts.main")

@section("content")
    <x-layout
        :title="__('Tags')"
        :breadcrumbPath="[
            [ 'href' => route('user.dashboard'), 'name' => __('Dashboard') ],
            [ 'href' => route('user.test-projects.index'), 'name' => __('Test projects')],
            [ 'name' => __('Tags')],
        ]"
    >
        <x-slot:subtitle>
            <x-ui.layout.subtitle>
                {{ __("See tags used by test projects") }}
            </x-ui.layout.subtitle>
        </x-slot:subtitle>

        <div>
            <section @class([ "flex flex-wrap gap-4" ])>
                @forelse($tags as $tag)
                    <a
                        class="tag"
                        href="{{ route("user.tags.show", [
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
    </x-layout>
@endsection
