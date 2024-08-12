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
        <x-admin.operations.route
            :title="__('Download')"
            :href="route('admin.test-projects.attachments.show', [
                'test_project' => $attachment->test_project_id,
                'attachment' => $attachment
            ])"
            icon="fa-download"
        />

        <x-admin.operations.route
            :title="__('Edit')"
            :href="route('admin.test-projects.attachments.edit', [
                'test_project' => $attachment->test_project_id,
                'attachment' => $attachment
            ])"
            icon="fa-pen-to-square"
        />

        <x-admin.operations.route
            :title="__('Delete')"
            href="#"
            icon="fa-trash"
        />
    </x-admin.operations.container>
</div>
