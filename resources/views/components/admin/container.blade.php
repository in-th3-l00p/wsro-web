<main class="flex">
    <x-admin.sidebar />

    <section class="flex-grow py-24 px-8 sm:px-16 md:px-32 mx-auto">
        <header class="mb-16">
            <h1 class="text-5xl font-bold">{{ $title }}</h1>
            @if (isset($subtitle))
                {{ $subtitle  }}
            @endif
        </header>


        {{ $slot }}
    </section>
</main>
