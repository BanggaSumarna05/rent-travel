<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\TourPackage;
use App\Models\Testimonial;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars         = Car::count();
        $totalMotorcycles  = Motorcycle::count();
        $totalTours        = TourPackage::count();
        $totalTestimonials = Testimonial::count();
        $totalTransactions = Transaction::count();
        $pendingTransactions = Transaction::where('status', 'pending')->count();
        $totalRevenue      = Transaction::whereIn('status', ['confirmed', 'completed'])->sum(DB::raw('total_price + penalty_amount - discount_amount'));

        // ── Chart 1: Transaksi per bulan (12 bulan terakhir) ──────────
        $monthlyData = [];
        $monthlyLabels = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $monthlyLabels[] = $month->isoFormat('MMM Y');
            $monthlyData[] = Transaction::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        // ── Chart 2: Distribusi tipe layanan ──────────────────────────
        $serviceTypes = Transaction::query()
            ->get()
            ->groupBy(fn (Transaction $transaction) => $transaction->serviceCategoryLabel())
            ->map(fn ($transactions) => $transactions->count())
            ->sortDesc();

        $serviceLabels = $serviceTypes->keys()->toArray();
        $serviceValues = $serviceTypes->values()->toArray();

        // ── Chart 3: Pendapatan harian (30 hari terakhir) ────────────
        $revenueLabels = [];
        $revenueData   = [];
        for ($i = 29; $i >= 0; $i--) {
            $day = Carbon::now()->subDays($i);
            $revenueLabels[] = $day->format('d/m');
            $revenueData[]   = (float) Transaction::whereIn('status', ['confirmed', 'completed'])
                ->whereDate('created_at', $day->toDateString())
                ->sum(DB::raw('total_price + penalty_amount - discount_amount'));
        }

        // ── Chart 4: Transaksi per status ─────────────────────────────
        $statusCounts = Transaction::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn ($item) => [$item->status => $item->total]);

        return view('admin.dashboard', compact(
            'totalCars', 'totalMotorcycles', 'totalTours', 'totalTestimonials',
            'totalTransactions', 'pendingTransactions', 'totalRevenue',
            'monthlyLabels', 'monthlyData',
            'serviceLabels', 'serviceValues',
            'revenueLabels', 'revenueData',
            'statusCounts'
        ));
    }
}
