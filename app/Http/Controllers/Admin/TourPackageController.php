<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        $tours = TourPackage::latest()->paginate(10);
        return view('admin.tour-packages.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tour-packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'itinerary' => 'nullable|array',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $tour = TourPackage::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $tour->addMedia($image)->toMediaCollection('tour_packages');
            }
        }

        return redirect()->route('admin.tour-packages.index')->with('success', 'Paket wisata berhasil ditambahkan.');
    }

    public function edit(TourPackage $tourPackage)
    {
        return view('admin.tour-packages.edit', compact('tourPackage'));
    }

    public function update(Request $request, TourPackage $tourPackage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'duration' => 'required|string',
            'price' => 'required|numeric',
            'itinerary' => 'nullable|array',
            'include' => 'nullable|string',
            'exclude' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $tourPackage->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $tourPackage->addMedia($image)->toMediaCollection('tour_packages');
            }
        }

        return redirect()->route('admin.tour-packages.index')->with('success', 'Paket wisata berhasil diperbarui.');
    }

    public function destroy(TourPackage $tourPackage)
    {
        $tourPackage->delete();
        return redirect()->route('admin.tour-packages.index')->with('success', 'Paket wisata berhasil dihapus.');
    }
}
