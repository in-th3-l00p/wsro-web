<div
    type="button"
    @class([
        "bg-white p-8 rounded-md shadow-md h-96 flex flex-col",
        "hover:scale-105 hover:shadow-lg transition-all"
    ])
>
    @if ($testProject->tags()->count() > 0)
        <div class="flex flex-wrap gap-2 mb-4">
            @foreach ($testProject->tags()->get() as $tag)
                <div class="rounded-2xl bg-rose-600 text-white px-3 py-1">
                    {{ $tag->name }}
                </div>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">{{ $testProject->title }}</h2>
    <div class="mb-auto">{!! $testProject->description !!}</div>

    <div class="flex gap-4">
        <a
            title="{{ __("Open test project") }}"
            href="{{ route("admin.testProjects.show", [ "test_project" => $testProject ]) }}"
            class="btn"
        >
            <i class="fa-solid fa-eye"></i>
            Open
        </a>
    </div>
</div>
