<div class="gallery-photos" data-masonry='{"item-selector":".grid-item", "columnWidth":464}'>
    @foreach ($post->photos->take(4) as $photo)
        <figure class="grid-item grid-item--height2">
            @if ($loop->iteration === 4)
                <div class="overlay">{{ $post->photos->count() }} Fotos</div>
            @endif
            <img src="{{ $photo->url }}" alt="{{ $post->title }}" class="img-responsive">
        </figure>
    @endforeach
</div>