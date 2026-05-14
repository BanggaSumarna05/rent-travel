<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    public function index(Request $request)
    {
        $query = Motorcycle::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        $motorcycles = $query->paginate(10)->withQueryString();

        $totalMotorcycles = Motorcycle::count();
        $totalActive = Motorcycle::where('status', 'active')->count();

        return view('admin.motorcycles.index', compact('motorcycles', 'totalMotorcycles', 'totalActive'));
    }

    public function create()
    {
        return view('admin.motorcycles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'price_per_month' => 'nullable|numeric',
            'engine_capacity' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20480'
        ]);

        $motorcycle = Motorcycle::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

            $motorcycle->addMedia($image)->toMediaCollection('motorcycles');
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $motorcycle->addMedia($video)->toMediaCollection('videos');
            }
        }

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motor berhasil ditambahkan.');
    }

    public function edit(Motorcycle $motorcycle)
    {
        return view('admin.motorcycles.edit', compact('motorcycle'));
    }

    public function update(Request $request, Motorcycle $motorcycle)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'price_per_day' => 'required|numeric',
            'price_per_month' => 'nullable|numeric',
            'engine_capacity' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'videos.*' => 'nullable|file|mimes:mp4,mov,ogg,qt|max:20480'
        ]);

        $motorcycle->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $motorcycle->addMedia($image)->toMediaCollection('motorcycles');
            }
        }

        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $motorcycle->addMedia($video)->toMediaCollection('videos');
            }
        }

        return redirect()->route('admin.motorcycles.index')->with('success', 'Motor berhasil diperbarui.');
    }

    public function destroy(Motorcycle $motorcycle)
    {
        $motorcycle->delete();
        return redirect()->route('admin.motorcycles.index')->with('success', 'Motor berhasil dihapus.');
    }
}
