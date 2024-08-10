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
        <form
            method="post"
            action="{{ route("admin.testProjects.restore", [
                "test_project" => $testProject
            ]) }}"
        >
            @csrf
            @method("PUT")

            <button
                type="submit"
                title="{{ __("Restore test project") }}"
                class="btn"
            >
                Restore
            </button>
        </form>
    </div>
</div>
