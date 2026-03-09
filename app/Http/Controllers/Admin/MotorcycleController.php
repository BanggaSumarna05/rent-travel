<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motorcycle;
use Illuminate\Http\Request;

class MotorcycleController extends Controller
{
    public function index()
    {
        $motorcycles = Motorcycle::latest()->paginate(10);
        return view('admin.motorcycles.index', compact('motorcycles'));
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
            'engine_capacity' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $motorcycle = Motorcycle::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $motorcycle->addMedia($image)->toMediaCollection('motorcycles');
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
            'engine_capacity' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $motorcycle->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $motorcycle->addMedia($image)->toMediaCollection('motorcycles');
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
