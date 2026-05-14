<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    <url>
        <loc>{{ route('cars.index') }}</loc>
        <priority>0.8</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach($cars as $car)
    <url>
        <loc>{{ route('cars.show', $car) }}</loc>
        <priority>0.7</priority>
        <lastmod>{{ optional($car->updated_at)->toDateString() }}</lastmod>
    </url>
    @endforeach
    <url>
        <loc>{{ route('motorcycles.index') }}</loc>
        <priority>0.8</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach($motorcycles as $motor)
    <url>
        <loc>{{ route('motorcycles.show', $motor) }}</loc>
        <priority>0.7</priority>
        <lastmod>{{ optional($motor->updated_at)->toDateString() }}</lastmod>
    </url>
    @endforeach
    <url>
        <loc>{{ route('tours.index') }}</loc>
        <priority>0.8</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach($tours as $tour)
    <url>
        <loc>{{ route('tours.show', $tour) }}</loc>
        <priority>0.7</priority>
        <lastmod>{{ optional($tour->updated_at)->toDateString() }}</lastmod>
    </url>
    @endforeach
    <url>
        <loc>{{ route('posts.index') }}</loc>
        <priority>0.6</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    @foreach($posts as $post)
    <url>
        <loc>{{ route('posts.show', $post) }}</loc>
        <priority>0.6</priority>
        <lastmod>{{ optional($post->updated_at ?? $post->published_at)->toDateString() }}</lastmod>
    </url>
    @endforeach
    <url>
        <loc>{{ route('about') }}</loc>
        <priority>0.5</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    <url>
        <loc>{{ route('faq') }}</loc>
        <priority>0.5</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <priority>0.5</priority>
        <lastmod>{{ now()->toDateString() }}</lastmod>
    </url>
</urlset>
