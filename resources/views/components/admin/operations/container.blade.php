<div {{ $attributes->merge([
    "class" => "w-full flex items-center gap-2 flex-wrap"
]) }}>
    @if ($text)
        <h2 class="text-lg me-2">Operations:</h2>
    @endif
    {{ $slot }}
</div>
