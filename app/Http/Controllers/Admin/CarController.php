<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index(Request $request)
    {
        $query = Car::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $cars = $query->paginate(10)->withQueryString();
        
        $totalCars = Car::count();
        $totalActive = Car::where('status', 'active')->count();
        $totalFeatured = Car::where('is_featured', true)->count();

        return view('admin.cars.index', compact('cars', 'totalCars', 'totalActive', 'totalFeatured'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|in:lepas_kunci,with_driver,carter_drop',
            'price_per_day' => 'required|numeric',
            'price_per_month' => 'nullable|numeric',
            'transmission' => 'required|string',
            'passenger_capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'year' => 'required|string',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20480'
        ]);

        $car = Car::create($validated);
        
        \App\Models\ActivityLog::log('Tambah Mobil', 'Manajemen Mobil', "Menambahkan mobil baru: {$car->name}");

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('cars');
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $car->addMedia($video)->toMediaCollection('videos');
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function edit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|in:lepas_kunci,with_driver,carter_drop',
            'price_per_day' => 'required|numeric',
            'price_per_month' => 'nullable|numeric',
            'transmission' => 'required|string',
            'passenger_capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'year' => 'required|string',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20480'
        ]);

        $oldName = $car->name;
        $car->update($validated);
        
        \App\Models\ActivityLog::log('Update Mobil', 'Manajemen Mobil', "Memperbarui data mobil: {$oldName} -> {$car->name}");

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('cars');
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $car->addMedia($video)->toMediaCollection('videos');
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        $name = $car->name;
        $car->delete();
        
        \App\Models\ActivityLog::log('Hapus Mobil', 'Manajemen Mobil', "Menghapus mobil: {$name}");

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
