@extends('layouts.admin')

@section('title', 'Manajemen Mobil')

@section('content')
    <div class="space-y-6 md:space-y-8 lg:space-y-10 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-slate-800 tracking-tight leading-tight">
                    Daftar Armada Mobil
                </h2>
                <p class="text-slate-500 font-semibold mt-1 md:mt-2 text-sm md:text-base">
                    Kelola inventaris mobil mewah dan status ketersediaannya.
                </p>
            </div>
            <a href="{{ route('admin.cars.create') }}"
                class="inline-flex items-center gap-2 md:gap-3 px-6 md:px-8 py-3 md:py-4 bg-teal-500 text-white rounded-xl md:rounded-2xl font-bold text-sm md:text-base hover:bg-teal-600 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-teal-500/20 w-full md:w-auto justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Mobil Baru
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl md:rounded-3xl lg:rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <!-- Mobile Card View -->
            <div class="md:hidden divide-y divide-gray-100">
                @foreach ($cars as $car)
                    <div class="p-6 hover:bg-slate-50/50 transition-colors">
                        <!-- Car Image & Basic Info -->
                        <div class="flex items-start gap-4 mb-4">
                            <div class="w-24 h-24 rounded-xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=200' }}"
                                    class="w-full h-full object-cover" alt="{{ $car->name }}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-black text-slate-800 tracking-tight leading-tight mb-2">
                                    {{ $car->name }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <span class="text-[10px] font-bold text-teal-600 uppercase tracking-wide px-2 py-1 bg-teal-50 rounded">
                                        {{ $car->brand }}
                                    </span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                                        {{ str_replace('_', ' ', $car->category) }}
                                    </span>
                                </div>
                                <div class="text-lg font-black text-slate-800 tracking-tight">
                                    Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    <span class="text-xs font-semibold text-slate-400">/hari</span>
                                </div>
                            </div>
                        </div>

                        <!-- Technical Details -->
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                {{ $car->transmission }}
                            </div>
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-600">
                                <svg class="w-4 h-4 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                {{ $car->passenger_capacity }} Kursi
                            </div>
                        </div>

                        <!-- Status Badges -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            @if ($car->status == 'active')
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-red-50 text-red-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-red-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Non-Aktif
                                </span>
                            @endif

                            @if ($car->is_featured)
                                <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-teal-50 text-teal-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-teal-100">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    Andalan
                                </span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('admin.cars.edit', $car) }}"
                                class="flex-1 flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl hover:bg-teal-50 hover:text-teal-600 transition-all border border-gray-100 font-semibold text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 text-slate-700 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all border border-gray-100 font-semibold text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                            <th class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Info Mobil
                            </th>
                            <th class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Detail Teknis
                            </th>
                            <th class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Harga Sewa
                            </th>
                            <th class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider text-right">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($cars as $car)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <!-- Car Info -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="flex items-center gap-4 lg:gap-6">
                                        <div class="w-16 h-16 lg:w-20 lg:h-20 rounded-xl lg:rounded-2xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                            <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=200' }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                alt="{{ $car->name }}">
                                        </div>
                                        <div>
                                            <div class="text-base lg:text-lg font-black text-slate-800 tracking-tight leading-tight mb-2">
                                                {{ $car->name }}
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-bold text-teal-600 uppercase tracking-wide">
                                                    {{ $car->brand }}
                                                </span>
                                                <div class="w-1 h-1 rounded-full bg-slate-300"></div>
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                                                    {{ str_replace('_', ' ', $car->category) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Technical Details -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="space-y-2 lg:space-y-3">
                                        <div class="flex items-center gap-2 lg:gap-3 text-xs font-semibold text-slate-600">
                                            <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                            {{ $car->transmission }}
                                        </div>
                                        <div class="flex items-center gap-2 lg:gap-3 text-xs font-semibold text-slate-600">
                                            <svg class="w-4 h-4 text-teal-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            {{ $car->passenger_capacity }} Kursi
                                        </div>
                                    </div>
                                </td>

                                <!-- Price -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="text-base lg:text-lg font-black text-slate-800 tracking-tight">
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    </div>
                                    <div class="text-[10px] font-semibold text-slate-400 uppercase tracking-wide mt-1">
                                        Per Hari
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="flex flex-col gap-2 lg:gap-3">
                                        @if ($car->status == 'active')
                                            <span class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-emerald-100 w-fit">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-red-50 text-red-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-red-100 w-fit">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                                Non-Aktif
                                            </span>
                                        @endif

                                        @if ($car->is_featured)
                                            <span class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-teal-50 text-teal-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-teal-100 w-fit">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                Andalan
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8 text-right">
                                    <div class="flex justify-end gap-2 lg:gap-3">
                                        <a href="{{ route('admin.cars.edit', $car) }}"
                                            class="p-2.5 lg:p-3 bg-slate-50 text-slate-600 rounded-lg lg:rounded-xl hover:bg-teal-50 hover:text-teal-600 hover:scale-110 transition-all border border-gray-100"
                                            title="Edit">
                                            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2.5 lg:p-3 bg-slate-50 text-slate-600 rounded-lg lg:rounded-xl hover:bg-red-50 hover:text-red-600 hover:scale-110 transition-all border border-gray-100"
                                                title="Hapus">
                                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if($cars->isEmpty())
                <div class="py-16 px-6 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Mobil</h3>
                    <p class="text-slate-500 text-sm mb-6">Mulai tambahkan mobil pertama Anda ke inventaris.</p>
                    <a href="{{ route('admin.cars.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-teal-500 text-white rounded-xl font-bold text-sm hover:bg-teal-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Tambah Mobil Baru
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endsection
