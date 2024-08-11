<div
    type="button"
    @class([
        "h-96 max-w-96",
        "bg-white p-8 rounded-md shadow-md flex flex-col gap-4",
        "hover:scale-105 hover:shadow-lg transition-all"
    ])
>
    @if ($testProject->tags()->count() > 0)
        <div class="flex flex-wrap gap-2">
            @foreach ($testProject->tags()->get() as $tag)
                <x-admin.test-projects.tag-display :tag="$tag" />
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-bold">{{ $testProject->title }}</h2>
    <div class="mb-auto h-18 overflow-hidden line-clamp-3 text-ellipsis">
        {!! $testProject->description !!}
    </div>

    <div class="flex gap-4">
        <a
            title="{{ __("Open test project") }}"
            href="{{ route("admin.test-projects.show", [ "test_project" => $testProject ]) }}"
            class="btn"
        >
            <i class="fa-solid fa-eye"></i>
            Open
        </a>
    </div>
</div>
