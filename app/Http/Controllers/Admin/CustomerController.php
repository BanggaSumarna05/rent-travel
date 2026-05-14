<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Mendapatkan customer_phone unik beserta data lengkap dari transaksi terakhir
        $latestTransactions = Transaction::select('customer_phone')
            ->selectRaw('MAX(id) as max_id')
            ->groupBy('customer_phone');

        $query = Transaction::joinSub($latestTransactions, 'latest', function ($join) {
                $join->on('transactions.id', '=', 'latest.max_id');
            })
            ->select('transactions.*');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('emergency_contact_phone', 'like', "%{$search}%");
            });
        }

        $customers = $query->orderBy('created_at', 'desc')->paginate(15);

        // Tambahkan jumlah transaksi untuk masing-masing customer
        foreach ($customers as $customer) {
            $customer->total_transactions = Transaction::where('customer_phone', $customer->customer_phone)->count();
        }

        return view('admin.customers.index', compact('customers'));
    }

    public function show($phone)
    {
        // Retrieve all transactions for this phone number
        $transactions = Transaction::where('customer_phone', $phone)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($transactions->isEmpty()) {
            abort(404, 'Data pelanggan tidak ditemukan.');
        }

        // Use the latest transaction for displaying profile & documents
        $customerInfo = $transactions->first();

        return view('admin.customers.show', compact('customerInfo', 'transactions'));
    }
}
