<main class="flex">
    <x-user.sidebar />

    <section class="layout-header">
        <header class="mb-8">
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
