<div class="w-full mb-4 flex items-center gap-4 flex-wrap">
    @if ($text)
        <h2 class="text-lg me-2">Operations:</h2>
    @endif
    {{ $slot }}
</div>
