<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Post;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class PostController extends Controller
{
    public function index()
    {
        $siteName = Setting::get('site_name', 'CJA Rent Car');
        $description = 'Baca artikel rental mobil Tasikmalaya, tips perjalanan, rekomendasi wisata, dan panduan sewa mobil agar perjalanan Anda lebih nyaman dan efisien.';
        $canonicalUrl = route('posts.index');
        $imageUrl = Setting::logoUrl();

        SEOMeta::setTitle('Artikel Rental Mobil Tasikmalaya');
        SEOMeta::setTitleSeparator(' | ');
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($canonicalUrl);
        SEOMeta::setKeywords([
            'artikel rental mobil tasikmalaya',
            'tips sewa mobil tasikmalaya',
            'berita rental mobil tasikmalaya',
            'panduan perjalanan tasikmalaya',
            $siteName,
        ]);

        OpenGraph::setTitle("Artikel Rental Mobil Tasikmalaya | {$siteName}");
        OpenGraph::setDescription($description);
        OpenGraph::setType('website');
        OpenGraph::setUrl($canonicalUrl);
        OpenGraph::addImage($imageUrl);

        TwitterCard::setTitle("Artikel Rental Mobil Tasikmalaya | {$siteName}");
        TwitterCard::setDescription($description);
        TwitterCard::addValue('image', $imageUrl);

        JsonLd::setType('CollectionPage');
        JsonLd::setTitle('Artikel Rental Mobil Tasikmalaya');
        JsonLd::setDescription($description);
        JsonLd::addValue('url', $canonicalUrl);

        $posts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(9);

        return view('frontend.posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        if (! $post->is_published || ! $post->published_at || $post->published_at->isFuture()) {
            abort(404);
        }

        $siteName = Setting::get('site_name', 'CJA Rent Car');
        $canonicalUrl = route('posts.show', $post);
        $description = $post->excerpt ?? mb_substr(strip_tags($post->content), 0, 155);
        $imageUrl = $post->getFirstMediaUrl('posts') ?: Setting::logoUrl();

        SEOMeta::setTitle($post->title);
        SEOMeta::setTitleSeparator(' | ');
        SEOMeta::setDescription($description);
        SEOMeta::setCanonical($canonicalUrl);
        SEOMeta::setKeywords(array_filter([
            $post->title,
            'artikel rental mobil tasikmalaya',
            'berita sewa mobil tasikmalaya',
            'tips perjalanan tasikmalaya',
            'CJA Rent Car',
        ]));

        OpenGraph::setTitle($post->title . " | {$siteName}");
        OpenGraph::setDescription($description);
        OpenGraph::setType('article');
        OpenGraph::setUrl($canonicalUrl);
        OpenGraph::addImage($imageUrl);
        OpenGraph::addProperty('article:published_time', $post->published_at->toIso8601String());
        OpenGraph::addProperty('article:modified_time', $post->updated_at->toIso8601String());

        TwitterCard::setTitle($post->title);
        TwitterCard::setDescription($description);
        TwitterCard::addValue('image', $imageUrl);

        JsonLd::setType('Article');
        JsonLd::setTitle($post->title);
        JsonLd::setDescription($description);
        JsonLd::addValue('url', $canonicalUrl);
        JsonLd::addValue('image', $imageUrl);
        JsonLd::addValue('datePublished', $post->published_at->toIso8601String());
        JsonLd::addValue('dateModified', $post->updated_at->toIso8601String());
        JsonLd::addValue('author', ['@type' => 'Organization', 'name' => 'CJA Rent Car']);
        JsonLd::addValue('publisher', [
            '@type' => 'Organization',
            'name' => $siteName,
            'logo' => [
                '@type' => 'ImageObject',
                'url' => Setting::logoUrl(),
            ],
        ]);

        $recentPosts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('frontend.posts.show', compact('post', 'recentPosts'));
    }
}
