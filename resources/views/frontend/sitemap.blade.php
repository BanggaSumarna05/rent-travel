<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('cars.index') }}</loc>
        <priority>0.8</priority>
    </url>
    @foreach($cars as $car)
    <url>
        <loc>{{ route('cars.show', $car) }}</loc>
        <priority>0.7</priority>
    </url>
    @endforeach
    <url>
        <loc>{{ route('motorcycles.index') }}</loc>
        <priority>0.8</priority>
    </url>
    @foreach($motorcycles as $motor)
    <url>
        <loc>{{ route('motorcycles.show', $motor) }}</loc>
        <priority>0.7</priority>
    </url>
    @endforeach
    <url>
        <loc>{{ route('tours.index') }}</loc>
        <priority>0.8</priority>
    </url>
    @foreach($tours as $tour)
    <url>
        <loc>{{ route('tours.show', $tour) }}</loc>
        <priority>0.7</priority>
    </url>
    @endforeach
    <url>
        <loc>{{ route('about') }}</loc>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('faq') }}</loc>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('contact') }}</loc>
        <priority>0.5</priority>
    </url>
</urlset>
