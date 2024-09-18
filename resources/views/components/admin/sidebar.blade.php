<x-ui.sidebar>
    <x-ui.sidebar.branding />

    <x-ui.sidebar.link
        route="admin.dashboard"
        icon="fa-chart-line"
    >
        {{ __("Dashboard") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.users.index"
        icon="fa-user"
    >
        {{ __("Users") }}
    </x-ui.sidebar.link>

    <x-ui.sidebar.link
        route="admin.test-projects.index"
        icon="fa-book"
    >
        {{ __("Test projects") }}
    </x-ui.sidebar.link>

    <!-- assignments route -->
    <x-ui.sidebar.link
        route="admin.assignments.index"
        icon="fa-file"
    >
        {{ __("Assignments") }}
    </x-ui.sidebar.link>


    <x-ui.sidebar.user />
</x-ui.sidebar>
