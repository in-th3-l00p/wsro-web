@push("vite")
    @vite([ "resources/scss/components/attachment.scss" ])
@endpush

<section>
    @if ($includeTitle)
        <h2 class="section-title">{{ __("Attachments") }}</h2>
    @endif

    <x-admin.operations.container class="mb-4">
        <x-admin.operations.route
            :title="__('Add')"
            :href="route('admin.test-projects.attachments.create', [
                        'test_project' => $testProject
                    ])"
            icon="fa-plus"
        />

        @if ($includeIndex)
            <x-admin.operations.route
                :title="__('Show only attachments')"
                :href="route('admin.test-projects.attachments.index', [
                            'test_project' => $testProject
                        ])"
                icon="fa-eye"
            />
        @endif

        <x-admin.operations.route
            :title="__('Trash')"
            :href="route('admin.test-projects.attachments.trash', [
                        'test_project' => $testProject
                    ])"
            icon="fa-trash"
        />
    </x-admin.operations.container>
    <div class="flex flex-wrap gap-8">
        @forelse ($attachments as $attachment)
            <x-admin.test-projects.attachments.attachment
                :attachment="$attachment"
            />
        @empty
            <p class="empty-text">{{ __("There are no attachments") }}</p>
        @endforelse
    </div>
</section>
