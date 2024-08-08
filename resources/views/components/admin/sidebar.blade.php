<x-ui.sidebar>
    <nav
        x-show="open"
        class="flex flex-col"
    >
        <a
            href="{{ route("admin.dashboard") }}"
            title="Logo"
            class="w-48"
        >
            <img
                src="/static/logo.png"
                alt="logo"
                class="w-48 px-8 py-8"
            >
        </a>

        <x-ui.sidebar-link
            route="admin.dashboard"
            icon="fa-chart-line"
        >
            Dashboard
        </x-ui.sidebar-link>

        <x-ui.sidebar-link
            route="admin.users"
            icon="fa-user"
        >
            Users
        </x-ui.sidebar-link>
    </nav>

    <button
        @click="open = !open"
        type="button"
        title="Open Sidebar"
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
</x-ui.sidebar>
