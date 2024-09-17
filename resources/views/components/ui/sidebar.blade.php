<aside
    x-data="{ open: true }"
    @class([
        "top-0 left-0 fixed xs:sticky h-screen",
        "flex flex-col",
    ])
>
    <div
        class="h-full overflow-x-hidden transition-width"
        x-bind:class="open ? 'w-full' : 'w-0'"
    >
        <nav
            @class([
                "flex flex-col w-screen xs:max-w-52 h-full bg-rose-700 shadow-rose-950 shadow-lg"
            ])
        >
            {{ $slot }}
        </nav>
    </div>

    <button
        @click="open = !open"
        type="button"
        x-bind:title="open ?
            {{ "'" . __('Close sidebar') . "'" }} :
            {{ '"' . __("Open sidebar") . '"' }}
        "
        @class([
            "absolute top-0 left-0",
            "rounded-md p-4 m-2 w-12 h-12 bg-rose-700",
            "flex justify-center items-center",
            "hover:bg-rose-500 hover:scale-105 transition-all"
        ])
        x-bind:class="open ? 'absolute' : ''"
    >
        <i x-show="open" class="sidebar-icon fa-regular fa-3xl fa-square-caret-left"></i>
        <i x-show="!open" class="sidebar-icon fa-regular fa-3xl fa-square-caret-right"></i>
    </button>
</aside>
