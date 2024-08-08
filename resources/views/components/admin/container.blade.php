<main class="flex">
    <x-admin.sidebar />

    <div class="flex-grow py-24 px-8 sm:px-16 md:px-32 mx-auto">
        <h1 class="text-5xl font-bold mb-16">{{ $title }}</h1>
        {{ $slot }}
    </div>
</main>
