<main class="flex">
    <x-admin.sidebar />

    <section class="flex-grow py-24 px-8 sm:px-16 md:px-32 mx-auto">
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
