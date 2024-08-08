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
        route="admin.users"
        icon="fa-user"
    >
        {{ __("Users") }}
    </x-ui.sidebar-link>
</x-ui.sidebar>
