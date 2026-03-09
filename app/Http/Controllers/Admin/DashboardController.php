<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\TourPackage;
use App\Models\Testimonial;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $totalMotorcycles = Motorcycle::count();
        $totalTours = TourPackage::count();
        $totalTestimonials = Testimonial::count();

        $totalTransactions = Transaction::count();
        $pendingTransactions = Transaction::where('status', 'pending')->count();
        $totalRevenue = Transaction::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        return view('admin.dashboard', compact(
            'totalCars',
            'totalMotorcycles',
            'totalTours',
            'totalTestimonials',
            'totalTransactions',
            'pendingTransactions',
            'totalRevenue'
        ));
    }
}
