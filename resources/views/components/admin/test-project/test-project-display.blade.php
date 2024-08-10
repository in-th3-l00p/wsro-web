<div
    type="button"
    @class([
        "bg-white p-8 rounded-md shadow-md h-96 flex flex-col",
        "hover:scale-105 hover:shadow-lg transition-all"
    ])
>
    <h2 class="text-xl font-bold mb-4">{{ $testProject->title }}</h2>
    <div class="mb-auto">{!! $testProject->description !!}</div>

    <div class="flex gap-4">
        <a
            title="{{ __("See test project") }}"
            href="{{ route("admin.testProjects.show", [ "test_project" => $testProject ]) }}"
            class="icon-btn"
        >
            <i class="fa-solid fa-eye"></i>
        </a>

        <a
            title="{{ __("Edit test project") }}"
            href="{{ route("admin.testProjects.edit", [ "test_project" => $testProject ]) }}"
            class="icon-btn"
        >
            <i class="fa-solid fa-pen-to-square"></i>
        </a>

        <a
            title="{{ __("Delete test project") }}"
            href="{{ route("admin.testProjects.edit", [ "test_project" => $testProject ]) }}"
            class="icon-btn"
        >
            <i class="fa-solid fa-trash"></i>
        </a>
    </div>
</div>
