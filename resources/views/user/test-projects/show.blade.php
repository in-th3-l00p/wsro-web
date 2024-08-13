@extends("layouts.main")

@push("vite")
    @vite([ "resources/scss/components/attachment.scss" ])
@endpush

@section("content")
    <x-user.layout
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

        <section>
            <h2 class="section-title">{{ __("Attachments") }}</h2>

            <div class="flex flex-wrap gap-8">
                @forelse ($testProject->attachments()->get() as $attachment)
                    <div class="attachment">
                        <i class="fa-solid fa-file fa-2xl icon"></i>
                        <h2 class="title">{{ $attachment->name }}</h2>
                        <div class="btn-group justify-center">
                            <a
                                title="{{ __('Download') }}"
                                href="{{ route('admin.test-projects.attachments.show', [
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
                    <p class="empty-text">{{ __("There are no attachments") }}</p>
                @endforelse
            </div>
        </section>
    </x-user.layout>
@endsection
