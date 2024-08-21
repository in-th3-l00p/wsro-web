<main class="flex">
    <x-admin.sidebar />

    <section class="layout-header">
        <header class="mb-16">
            @if ($breadcrumbPath)
                <x-ui.breadcrumbs :path="$breadcrumbPath" />
            @endif
            <h1 class="page-title">{{ $title }}</h1>
            @if (isset($subtitle))
                {{ $subtitle  }}
            @endif
        </header>

        {{ $slot }}
    </section>
</main>
