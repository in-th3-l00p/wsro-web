@push("styles")
    @vite([ "resources/scss/components/tag.scss" ])
@endpush
<div class="tag">
    {{ $tag->name }}
</div>
