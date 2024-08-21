<aside
    x-data="{ open: true }"
    @class([
        "top-0 left-0 fixed w-screen xs:h-screen xs:max-w-52",
        "flex flex-col",
        "bg-rose-700 flex gap-2 shadow-rose-950 shadow-lg"
    ])
    x-bind:class="open ? 'h-screen xs:sticky' : 'rounded-md shadow-none bg-transparent xs:max-w-fit'"
>
    <nav
        x-show="open"
        class="flex flex-col h-full"
        style="display: none;"
    >
        {{ $slot }}
    </nav>

    <button
        @click="open = !open"
        type="button"
        x-bind:title="open ?
            {{ "'" . __('Close sidebar') . "'" }} :
            {{ '"' . __("Open sidebar") . '"' }}
        "
        @class([
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
