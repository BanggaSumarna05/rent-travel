<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::with('bookable')->latest()->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cars = \App\Models\Car::all();
        $motorcycles = \App\Models\Motorcycle::all();
        $tourPackages = \App\Models\TourPackage::all();

        return view('admin.transactions.create', compact('cars', 'motorcycles', 'tourPackages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'bookable_type' => 'required|string',
            'bookable_id' => 'required|integer',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        // Resolve bookable
        $modelClass = 'App\\Models\\' . $validated['bookable_type'];
        if (!class_exists($modelClass)) {
            return back()->with('error', 'Layanan tidak valid.')->withInput();
        }

        $bookable = $modelClass::findOrFail($validated['bookable_id']);

        // Calculate total price
        $totalPrice = 0;
        if ($validated['bookable_type'] === 'TourPackage') {
            $totalPrice = $bookable->price;
        }
        else {
            $start = \Carbon\Carbon::parse($validated['start_date']);
            $end = $validated['end_date'] ?\Carbon\Carbon::parse($validated['end_date']) : $start;
            $days = $start->diffInDays($end) ?: 1;
            $totalPrice = $bookable->price_per_day * $days;
        }

        $validated['bookable_type'] = $modelClass;
        $validated['total_price'] = $totalPrice;

        Transaction::create($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dibuat secara manual.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('admin.transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
