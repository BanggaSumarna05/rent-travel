<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\TourPackage;
use App\Models\Testimonial;
use App\Models\Faq;
use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredCars = Car::where('is_featured', true)->where('status', 'active')->take(6)->get();
        $testimonials = Testimonial::where('is_active', true)->latest()->take(6)->get();
        $featuredTours = TourPackage::where('status', 'active')->latest()->take(3)->get();
        return view('frontend.home', compact('featuredCars', 'testimonials', 'featuredTours'));
    }

    public function cars(Request $request)
    {
        $query = Car::where('status', 'active');

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->sort == 'price_low') {
            $query->orderBy('price_per_day', 'asc');
        }
        elseif ($request->sort == 'price_high') {
            $query->orderBy('price_per_day', 'desc');
        }
        else {
            $query->latest();
        }

        $cars = $query->paginate(9);
        return view('frontend.cars.index', compact('cars'));
    }

    public function carDetail(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }

    public function motorcycles()
    {
        $motorcycles = Motorcycle::where('status', 'active')->latest()->paginate(9);
        return view('frontend.motorcycles.index', compact('motorcycles'));
    }

    public function motorcycleDetail(Motorcycle $motorcycle)
    {
        return view('frontend.motorcycles.show', compact('motorcycle'));
    }

    public function tours()
    {
        $tours = TourPackage::where('status', 'active')->latest()->paginate(9);
        return view('frontend.tours.index', compact('tours'));
    }

    public function tourDetail(TourPackage $tourPackage)
    {
        return view('frontend.tours.show', compact('tourPackage'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('frontend.faq', compact('faqs'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function sitemap()
    {
        $cars = Car::where('status', 'active')->get();
        $motorcycles = Motorcycle::where('status', 'active')->get();
        $tours = TourPackage::where('status', 'active')->get();

        return response()->view('frontend.sitemap', [
            'cars' => $cars,
            'motorcycles' => $motorcycles,
            'tours' => $tours,
        ])->header('Content-Type', 'text/xml');
    }
}
