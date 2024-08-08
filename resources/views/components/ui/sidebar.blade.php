<aside
    x-data="{ open: false }"
    class="bg-rose-700 min-h-screen flex gap-2 shadow-rose-950 shadow-lg"
>
    <nav
        x-show="open"
        class="flex flex-col"
        style="display: none;"
    >
        {{ $slot }}
    </nav>

    <button
        @click="open = !open"
        type="button"
        x-bind:title="open ? 'Close sidebar' : 'Open sidebar'"
        @class([
            "rounded-md p-4 m-2 w-12 h-12",
            "flex justify-center items-center",
            "hover:bg-rose-500 hover:scale-105 transition-all"
        ])
        x-bind:class="open ? 'absolute' : ''"
    >
        <i x-show="open" class="sidebar-icon fa-regular fa-3xl fa-square-caret-left"></i>
        <i x-show="!open" class="sidebar-icon fa-regular fa-3xl fa-square-caret-right"></i>
    </button>
</aside>
