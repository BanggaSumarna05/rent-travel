@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container mx-auto px-4">
    <header class="mb-6">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100">Dashboard</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">Ikhtisar singkat statistik dan tindakan cepat untuk manajemen.</p>
    </header>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-teal-500 to-teal-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all min-h-[160px] flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
            <div class="text-teal-100 text-sm font-semibold uppercase tracking-wider">Total Cars</div>
            <svg class="w-10 h-10 text-teal-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
        </div>
        <div class="text-4xl font-bold mb-2">{{ $totalCars ?? 0 }}</div>
        <a href="{{ route('admin.cars.index') }}" class="text-teal-100 text-sm hover:text-white inline-flex items-center gap-1 focus:outline-none focus:ring-2 focus:ring-teal-200 rounded">
            Manage Cars <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all min-h-[160px] flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
            <div class="text-blue-100 text-sm font-semibold uppercase tracking-wider">Motorcycles</div>
            <svg class="w-10 h-10 text-blue-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
        </div>
        <div class="text-4xl font-bold mb-2">{{ $totalMotorcycles ?? 0 }}</div>
        <a href="{{ route('admin.motorcycles.index') }}" class="text-blue-100 text-sm hover:text-white inline-flex items-center gap-1 focus:outline-none focus:ring-2 focus:ring-blue-200 rounded">
            Manage Motorcycles <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all min-h-[160px] flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
            <div class="text-purple-100 text-sm font-semibold uppercase tracking-wider">Tour Packages</div>
            <svg class="w-10 h-10 text-purple-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
        </div>
        <div class="text-4xl font-bold mb-2">{{ $totalTours ?? 0 }}</div>
        <a href="{{ route('admin.tour-packages.index') }}" class="text-purple-100 text-sm hover:text-white inline-flex items-center gap-1 focus:outline-none focus:ring-2 focus:ring-purple-200 rounded">
            Manage Tours <span aria-hidden="true">→</span>
        </a>
    </div>

    <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-xl transition-all min-h-[160px] flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
            <div class="text-orange-100 text-sm font-semibold uppercase tracking-wider">Testimonials</div>
            <svg class="w-10 h-10 text-orange-200 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
        </div>
        <div class="text-4xl font-bold mb-2">{{ $totalTestimonials ?? 0 }}</div>
        <a href="{{ route('admin.testimonials.index') }}" class="text-orange-100 text-sm hover:text-white inline-flex items-center gap-1 focus:outline-none focus:ring-2 focus:ring-orange-200 rounded">
            Manage Testimonials <span aria-hidden="true">→</span>
        </a>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="bg-white dark:bg-gray-800 rounded-2xl shadow-soft p-8 mb-8">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6 flex items-center gap-3">
        <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        Quick Actions
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Cars -->
        <div class="border-2 border-teal-100 rounded-xl p-5 hover:border-teal-300 transition-all hover:shadow-md focus-within:ring-2 focus-within:ring-teal-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Cars</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.cars.create') }}" class="flex-1 bg-teal-600 text-white text-center py-2 rounded-lg hover:bg-teal-700 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-teal-300" aria-label="Add new car">+ Add New</a>
                <a href="{{ route('admin.cars.index') }}" class="flex-1 border-2 border-teal-600 text-teal-600 text-center py-2 rounded-lg hover:bg-teal-50 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-teal-300" aria-label="View all cars">View All</a>
            </div>
        </div>

        <!-- Motorcycles -->
        <div class="border-2 border-blue-100 rounded-xl p-5 hover:border-blue-300 transition-all hover:shadow-md focus-within:ring-2 focus-within:ring-blue-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Motorcycles</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.motorcycles.create') }}" class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-blue-300" aria-label="Add new motorcycle">+ Add New</a>
                <a href="{{ route('admin.motorcycles.index') }}" class="flex-1 border-2 border-blue-600 text-blue-600 text-center py-2 rounded-lg hover:bg-blue-50 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-blue-300" aria-label="View all motorcycles">View All</a>
            </div>
        </div>

        <!-- Tour Packages -->
        <div class="border-2 border-purple-100 rounded-xl p-5 hover:border-purple-300 transition-all hover:shadow-md focus-within:ring-2 focus-within:ring-purple-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Tour Packages</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.tour-packages.create') }}" class="flex-1 bg-purple-600 text-white text-center py-2 rounded-lg hover:bg-purple-700 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-purple-300" aria-label="Add new tour package">+ Add New</a>
                <a href="{{ route('admin.tour-packages.index') }}" class="flex-1 border-2 border-purple-600 text-purple-600 text-center py-2 rounded-lg hover:bg-purple-50 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-purple-300" aria-label="View all tour packages">View All</a>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="border-2 border-orange-100 rounded-xl p-5 hover:border-orange-300 transition-all hover:shadow-md focus-within:ring-2 focus-within:ring-orange-200">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Testimonials</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.testimonials.create') }}" class="flex-1 bg-orange-600 text-white text-center py-2 rounded-lg hover:bg-orange-700 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-orange-300" aria-label="Add new testimonial">+ Add New</a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex-1 border-2 border-orange-600 text-orange-600 text-center py-2 rounded-lg hover:bg-orange-50 transition text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-orange-300" aria-label="View all testimonials">View All</a>
            </div>
        </div>

        <!-- FAQs -->
        <div class="border-2 border-green-100 rounded-xl p-5 hover:border-green-300 transition-all hover:shadow-md">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">FAQs</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.faqs.create') }}" class="flex-1 bg-green-600 text-white text-center py-2 rounded-lg hover:bg-green-700 transition text-sm font-semibold">+ Add New</a>
                <a href="{{ route('admin.faqs.index') }}" class="flex-1 border-2 border-green-600 text-green-600 text-center py-2 rounded-lg hover:bg-green-50 transition text-sm font-semibold">View All</a>
            </div>
        </div>

        <!-- Settings -->
        <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-gray-300 transition-all hover:shadow-md">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>
                <h3 class="font-bold text-gray-800">Global Settings</h3>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.settings.index') }}" class="flex-1 bg-gray-700 text-white text-center py-2 rounded-lg hover:bg-gray-800 transition text-sm font-semibold">Configure</a>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity / Tips -->
<div class="bg-gradient-to-r from-teal-50 to-blue-50 rounded-2xl p-8 border border-teal-100">
    <h3 class="text-xl font-bold text-gray-800 mb-4">💡 Quick Tips</h3>
    <ul class="space-y-3 text-gray-700">
        <li class="flex items-start gap-3">
            <span class="text-teal-600 font-bold">•</span>
            <span>Use <strong>Featured</strong> checkbox on cars to display them on the homepage</span>
        </li>
        <li class="flex items-start gap-3">
            <span class="text-teal-600 font-bold">•</span>
            <span>Update <strong>Global Settings</strong> to change WhatsApp number and contact info</span>
        </li>
        <li class="flex items-start gap-3">
            <span class="text-teal-600 font-bold">•</span>
            <span>Add <strong>Testimonials</strong> to build trust with potential customers</span>
        </li>
        <li class="flex items-start gap-3">
            <span class="text-teal-600 font-bold">•</span>
            <span>Keep <strong>FAQs</strong> updated to reduce customer support queries</span>
        </li>
    </ul>
</div>
@endsection
