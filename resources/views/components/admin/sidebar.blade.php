<x-ui.sidebar>
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
        {{ __("Dashboard") }}
    </x-ui.sidebar-link>

    <x-ui.sidebar-link
        route="admin.users.index"
        icon="fa-user"
    >
        {{ __("Users") }}
    </x-ui.sidebar-link>

    <x-ui.sidebar-link
        route="admin.test-projects.index"
        icon="fa-file"
    >
        {{ __("Test projects") }}
    </x-ui.sidebar-link>

    <div
        x-data="{ open: false }"
        class="mt-auto w-full"
    >
        <button
            type="button"
            class="sidebar-nav-link w-full"
            @click="open = !open"
        >
            <i class="fa-solid fa-2xl fa-user text-white"></i>
            <div>{{ request()->user()->name }}</div>
        </button>
        <nav x-show="open">
            <x-ui.sidebar-link
                route="logout"
                icon="fa-right-from-bracket"
            >
                {{ __("Logout") }}
            </x-ui.sidebar-link>
        </nav>
    </div>
</x-ui.sidebar>
