<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->paginate(10);
        return view('admin.cars.index', compact('cars'));
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
            'transmission' => 'required|string',
            'passenger_capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'year' => 'required|string',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $car = Car::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('cars');
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
            'transmission' => 'required|string',
            'passenger_capacity' => 'required|integer',
            'fuel_type' => 'required|string',
            'year' => 'required|string',
            'description' => 'nullable|string',
            'is_featured' => 'boolean',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $car->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $car->addMedia($image)->toMediaCollection('cars');
            }
        }

        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }
}
