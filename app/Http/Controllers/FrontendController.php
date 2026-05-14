<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Faq;
use App\Models\Motorcycle;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    private function setOgImage(?string $url = null): void
    {
        $image = $url ?: Setting::logoUrl();
        OpenGraph::addImage($image);
        TwitterCard::addValue('image', $image);
    }

    private function siteName(): string
    {
        return Setting::get('site_name', 'CJA Rent Car');
    }

    private function defaultKeywords(): array
    {
        return [
            'rental mobil tasikmalaya',
            'sewa mobil tasikmalaya',
            'rental mobil tasikmalaya lepas kunci',
            'rental mobil tasikmalaya dengan driver',
            'harga sewa mobil tasikmalaya',
            'rental mobil bandara tasikmalaya',
            'CJA Rent Car',
        ];
    }

    private function applySeo(
        string $title,
        string $description,
        array $keywords = [],
        ?string $image = null,
        string $type = 'website',
        ?string $canonical = null
    ): void {
        $siteName = $this->siteName();
        $fullTitle = str_contains($title, $siteName) ? $title : "{$title} | {$siteName}";
        $canonicalUrl = $canonical ?: url()->current();

        SEOMeta::setTitle($title);
        SEOMeta::setTitleSeparator(' | ');
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords(array_values(array_unique(array_merge($this->defaultKeywords(), $keywords))));
        SEOMeta::setCanonical($canonicalUrl);

        OpenGraph::setTitle($fullTitle);
        OpenGraph::setDescription($description);
        OpenGraph::setType($type);
        OpenGraph::setUrl($canonicalUrl);
        $this->setOgImage($image);

        TwitterCard::setTitle($fullTitle);
        TwitterCard::setDescription($description);

        JsonLd::setTitle($title);
        JsonLd::setDescription($description);
        JsonLd::setType($type === 'article' ? 'Article' : 'WebPage');
        JsonLd::addValue('url', $canonicalUrl);
    }

    public function index()
    {
        $this->applySeo(
            'Sewa Mobil Tasikmalaya & Rental Motor Murah | CJA Rent Car',
            'Sewa mobil Tasikmalaya murah di CJA Rent Car. Tersedia lepas kunci atau dengan supir. Hubungi 0852-2039-9817 untuk booking armada Anda hari ini!',
            [
                'sewa mobil tasikmalaya',
                'rental mobil tasikmalaya',
                'sewa motor tasikmalaya',
                'paket wisata tasikmalaya',
                'rental mobil tasikmalaya lepas kunci',
            ],
            asset('landing.png'),
            'website',
            route('home')
        );

        $featuredCars = Car::with('media')
            ->where('is_featured', true)
            ->where('status', 'active')
            ->take(6)
            ->get();

        if ($featuredCars->isEmpty()) {
            $featuredCars = Car::with('media')
                ->where('status', 'active')
                ->latest()
                ->take(6)
                ->get();
        }

        $secondaryCars = Car::with('media')
            ->where('status', 'active')
            ->when($featuredCars->isNotEmpty(), function ($query) use ($featuredCars) {
                $query->whereNotIn('id', $featuredCars->pluck('id'));
            })
            ->latest()
            ->take(3)
            ->get();

        if ($secondaryCars->isEmpty()) {
            $secondaryCars = $featuredCars->skip(1)->take(3)->values();
        }

        $testimonials = Testimonial::with('media')
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $featuredTours = TourPackage::with('media')
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $featuredMotorcycles = Motorcycle::with('media')
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        $faqs = Faq::all();
        $posts = Post::with('media')
            ->where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        $allCars = Car::where('status', 'active')->get();
        $allMotorcycles = Motorcycle::where('status', 'active')->get();
        $allTours = TourPackage::where('status', 'active')->get();

        return view('frontend.home', compact('featuredCars', 'secondaryCars', 'testimonials', 'featuredTours', 'faqs', 'posts', 'featuredMotorcycles', 'allCars', 'allMotorcycles', 'allTours'));
    }

    public function cars(Request $request)
    {
        $this->applySeo(
            'Rental Mobil Tasikmalaya | Harga Lepas Kunci & Driver',
            'Cari rental mobil lepas kunci atau dengan sopir di Tasikmalaya? Kami sediakan armada matic/manual terawat untuk dinas & keluarga. Harga dijamin transparan!',
            [
                'harga rental mobil tasikmalaya',
                'sewa mobil tasikmalaya lepas kunci',
                'sewa mobil tasikmalaya dengan driver',
                'rental mobil tasikmalaya harian',
            ],
            asset('landing.png'),
            'website',
            route('cars.index')
        );

        $query = Car::with('media')->where('status', 'active');

        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('category', $request->categories);
        } elseif ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('brand', 'like', '%' . $searchTerm . '%')
                    ->orWhere('description', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->sort === 'price_low') {
            $query->orderBy('price_per_day', 'asc');
        } elseif ($request->sort === 'price_high') {
            $query->orderBy('price_per_day', 'desc');
        } else {
            $query->latest();
        }

        $cars = $query->paginate(9)->withQueryString();

        return view('frontend.cars.index', compact('cars'));
    }

    public function carDetail(Car $car)
    {
        $title = "{$car->name} | Rental Mobil Tasikmalaya";
        $description = 'Rental mobil ' . $car->name . ' di Tasikmalaya mulai Rp ' . number_format($car->price_per_day, 0, ',', '.') . '/hari. Kapasitas ' . $car->passenger_capacity . ' kursi, transmisi ' . $car->transmission . ', cocok untuk perjalanan harian atau luar kota.';
        $imageUrl = $car->getFirstMediaUrl('cars') ?: Setting::logoUrl();

        $this->applySeo(
            $title,
            $description,
            [
                'rental ' . $car->name . ' tasikmalaya',
                'sewa ' . $car->name . ' tasikmalaya',
                'rental ' . $car->brand . ' tasikmalaya',
            ],
            $imageUrl,
            'product',
            route('cars.show', $car)
        );

        JsonLd::setType('Product');
        JsonLd::setTitle($car->name);
        JsonLd::setDescription($description);
        JsonLd::addValue('image', $imageUrl);
        JsonLd::addValue('offers', [
            '@type' => 'Offer',
            'priceCurrency' => 'IDR',
            'price' => $car->price_per_day,
            'availability' => 'https://schema.org/InStock',
            'url' => route('cars.show', $car),
        ]);

        return view('frontend.cars.show', compact('car'));
    }

    public function motorcycles()
    {
        $this->applySeo(
            'Sewa Motor Tasikmalaya | Matic Harian',
            'Sewa motor Tasikmalaya untuk kebutuhan harian, perjalanan singkat, dan wisata kota dengan unit matic terawat serta harga terjangkau.',
            ['sewa motor tasikmalaya', 'rental motor tasikmalaya', 'sewa motor matic tasikmalaya'],
            Setting::logoUrl(),
            'website',
            route('motorcycles.index')
        );

        $motorcycles = Motorcycle::with('media')->where('status', 'active')->latest()->paginate(9);

        return view('frontend.motorcycles.index', compact('motorcycles'));
    }

    public function motorcycleDetail(Motorcycle $motorcycle)
    {
        $title = "{$motorcycle->name} | Sewa Motor Tasikmalaya";
        $description = 'Sewa ' . $motorcycle->name . ' di Tasikmalaya mulai Rp ' . number_format($motorcycle->price_per_day, 0, ',', '.') . '/hari. Kondisi prima, irit, dan siap dipakai untuk mobilitas harian.';
        $imageUrl = $motorcycle->getFirstMediaUrl('motorcycles') ?: Setting::logoUrl();

        $this->applySeo(
            $title,
            $description,
            ['sewa ' . $motorcycle->name . ' tasikmalaya', 'rental motor tasikmalaya'],
            $imageUrl,
            'product',
            route('motorcycles.show', $motorcycle)
        );

        JsonLd::setType('Product');
        JsonLd::setTitle($motorcycle->name);
        JsonLd::setDescription($description);
        JsonLd::addValue('image', $imageUrl);
        JsonLd::addValue('offers', [
            '@type' => 'Offer',
            'priceCurrency' => 'IDR',
            'price' => $motorcycle->price_per_day,
            'url' => route('motorcycles.show', $motorcycle),
        ]);

        return view('frontend.motorcycles.show', compact('motorcycle'));
    }

    public function tours()
    {
        $this->applySeo(
            'Paket Wisata Tasikmalaya & Sekitarnya',
            'Pilih paket wisata Tasikmalaya dan sekitarnya dengan armada nyaman, jadwal fleksibel, dan layanan perjalanan yang sudah disiapkan lebih praktis.',
            ['paket wisata tasikmalaya', 'tour tasikmalaya', 'wisata tasikmalaya murah', 'paket tour pangandaran'],
            Setting::logoUrl(),
            'website',
            route('tours.index')
        );

        $tours = TourPackage::with('media')->where('status', 'active')->latest()->paginate(9);

        return view('frontend.tours.index', compact('tours'));
    }

    public function tourDetail(TourPackage $tourPackage)
    {
        $title = "{$tourPackage->name} | Paket Wisata Tasikmalaya";
        $description = 'Paket wisata ' . $tourPackage->name . ' selama ' . $tourPackage->duration . '. Mulai dari Rp ' . number_format($tourPackage->price, 0, ',', '.') . ' dengan armada nyaman dan itinerary yang praktis.';
        $imageUrl = $tourPackage->getFirstMediaUrl('tour_packages') ?: Setting::logoUrl();

        $this->applySeo(
            $title,
            $description,
            ['paket wisata ' . $tourPackage->name, 'paket wisata tasikmalaya', 'tour tasikmalaya'],
            $imageUrl,
            'website',
            route('tours.show', $tourPackage)
        );

        JsonLd::setType('TouristTrip');
        JsonLd::setTitle($tourPackage->name);
        JsonLd::setDescription($description);
        JsonLd::addValue('image', $imageUrl);
        JsonLd::addValue('offers', [
            '@type' => 'Offer',
            'priceCurrency' => 'IDR',
            'price' => $tourPackage->price,
            'url' => route('tours.show', $tourPackage),
        ]);

        return view('frontend.tours.show', compact('tourPackage'));
    }

    public function about()
    {
        $this->applySeo(
            'Tentang CJA Rent Car | Rental Mobil Tasikmalaya',
            'Kenal lebih dekat dengan CJA Rent Car, penyedia rental mobil Tasikmalaya yang fokus pada armada terawat, respon cepat, dan layanan perjalanan yang aman.',
            ['tentang CJA Rent Car', 'sewa mobil tasikmalaya terpercaya', 'rental mobil profesional tasikmalaya'],
            Setting::logoUrl(),
            'website',
            route('about')
        );

        return view('frontend.about');
    }

    public function faq()
    {
        $this->applySeo(
            'FAQ Rental Mobil Tasikmalaya',
            'Baca pertanyaan umum tentang rental mobil Tasikmalaya, mulai dari syarat sewa, sistem booking, durasi pemakaian, sampai pilihan driver.',
            ['FAQ sewa mobil tasikmalaya', 'cara sewa mobil tasikmalaya', 'syarat sewa mobil'],
            Setting::logoUrl(),
            'website',
            route('faq')
        );

        $faqs = Faq::all();

        return view('frontend.faq', compact('faqs'));
    }

    public function contact()
    {
        $this->applySeo(
            'Kontak Rental Mobil Tasikmalaya | Booking Cepat',
            'Hubungi CJA Rent Car untuk booking rental mobil Tasikmalaya via WhatsApp, telepon, atau email. Admin siap membantu cek unit dan jadwal.',
            ['kontak sewa mobil tasikmalaya', 'reservasi sewa mobil tasikmalaya', 'WhatsApp sewa mobil tasikmalaya'],
            Setting::logoUrl(),
            'website',
            route('contact')
        );

        return view('frontend.contact');
    }

    public function testimonials()
    {
        $this->applySeo(
            'Testimoni Pelanggan | Rental Mobil Tasikmalaya',
            'Apa kata pelanggan tentang layanan CJA Rent Car? Lihat berbagai ulasan dari pelanggan yang telah menggunakan jasa sewa mobil dan paket wisata kami.',
            ['testimoni sewa mobil tasikmalaya', 'ulasan CJA Rent Car', 'review rental mobil tasikmalaya'],
            Setting::logoUrl(),
            'website',
            route('testimonials')
        );

        $testimonials = Testimonial::with('media')
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('frontend.testimonials', compact('testimonials'));
    }

    public function search(Request $request)
    {
        $query = trim((string) $request->query('q', ''));

        $this->applySeo(
            $query !== '' ? "Hasil Pencarian: {$query}" : 'Pencarian Layanan Rental',
            'Cari mobil, motor, paket wisata, dan artikel yang tersedia di website CJA Rent Car.',
            ['pencarian rental mobil tasikmalaya', 'cari mobil sewa tasikmalaya', 'cari paket wisata tasikmalaya'],
            Setting::logoUrl(),
            'website',
            route('search', ['q' => $query ?: null])
        );

        $cars = Car::query()->with('media')->where('status', 'active');
        $motorcycles = Motorcycle::query()->with('media')->where('status', 'active');
        $tours = TourPackage::query()->with('media')->where('status', 'active');
        $posts = Post::query()
            ->with('media')
            ->where('is_published', true)
            ->where('published_at', '<=', now());

        if ($query !== '') {
            $cars->where(function ($builder) use ($query) {
                $builder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('brand', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });

            $motorcycles->where(function ($builder) use ($query) {
                $builder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('brand', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });

            $tours->where(function ($builder) use ($query) {
                $builder->where('name', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('include', 'like', '%' . $query . '%');
            });

            $posts->where(function ($builder) use ($query) {
                $builder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('excerpt', 'like', '%' . $query . '%')
                    ->orWhere('content', 'like', '%' . $query . '%');
            });
        }

        return view('frontend.search', [
            'query' => $query,
            'cars' => $cars->latest()->take(6)->get(),
            'motorcycles' => $motorcycles->latest()->take(6)->get(),
            'tours' => $tours->latest()->take(6)->get(),
            'posts' => $posts->latest('published_at')->take(6)->get(),
        ]);
    }

    public function privacyPolicy()
    {
        $this->applySeo(
            'Kebijakan Privasi',
            'Informasi privasi dan pengelolaan data pelanggan pada website CJA Rent Car.',
            ['kebijakan privasi rental mobil tasikmalaya', 'privasi CJA Rent Car'],
            Setting::logoUrl(),
            'website',
            route('privacy-policy')
        );

        return view('frontend.privacy-policy');
    }

    public function termsOfService()
    {
        $this->applySeo(
            'Syarat dan Ketentuan',
            'Syarat penggunaan website dan proses booking layanan di CJA Rent Car.',
            ['syarat ketentuan rental mobil tasikmalaya', 'terms CJA Rent Car'],
            Setting::logoUrl(),
            'website',
            route('terms-of-service')
        );

        return view('frontend.terms-of-service');
    }

    public function sitemap()
    {
        $cars = Car::where('status', 'active')->get();
        $motorcycles = Motorcycle::where('status', 'active')->get();
        $tours = TourPackage::where('status', 'active')->get();
        $posts = Post::where('is_published', true)
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->get();

        return response()->view('frontend.sitemap', [
            'cars' => $cars,
            'motorcycles' => $motorcycles,
            'tours' => $tours,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
