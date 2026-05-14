@extends('layouts.admin')

@section('title', 'Tambah Transaksi Manual')

@section('content')
    <div class="space-y-10 animate-fade-in" x-data="{
        bookableType: 'Car',
        bookableId: '',
        cars: @js($cars),
        motorcycles: @js($motorcycles),
        tours: @js($tourPackages),
        get filteredServices() {
            if (this.bookableType === 'Car') return this.cars;
            if (this.bookableType === 'Motorcycle') return this.motorcycles;
            if (this.bookableType === 'TourPackage') return this.tours;
            return [];
        }
    }">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight font-heading">
                    Tambah Transaksi <span class="text-amber-500">Manual</span>
                </h2>
                <p class="text-slate-500 font-semibold mt-1">Input pemesanan pelanggan yang dilakukan di luar website.</p>
            </div>
            <a href="{{ route('admin.transactions.index') }}"
                class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <form action="{{ route('admin.transactions.store') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            @csrf

            <!-- Left Column: Form Fields -->
            <div class="lg:col-span-2 space-y-10">
                <!-- Customer Info Card -->
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-8">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Informasi Pelanggan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                                Pelanggan</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800"
                                placeholder="Jaka Setia">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor
                                WhatsApp</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800"
                                placeholder="081234567890">
                        </div>
                        <div class="space-y-2 lg:col-span-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Email
                                (Opsional)</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800"
                                placeholder="jaka@example.com">
                        </div>
                        
                        <!-- Form Kontak Darurat -->
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">No. Telepon Darurat</label>
                            <input type="tel" name="emergency_contact_phone" value="{{ old('emergency_contact_phone') }}"
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800"
                                placeholder="08xxxxxxxxxx">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Hubungan Darurat (Opsional)</label>
                            <input type="text" name="emergency_contact_relation" value="{{ old('emergency_contact_relation') }}"
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800"
                                placeholder="Contoh: Istri / Orang Tua">
                        </div>

                        <!-- Dokumen Uploads -->
                        <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Upload KTP (Opsional)</label>
                                <input type="file" name="doc_ktp" accept="image/*,.pdf"
                                    class="w-full px-4 py-4 bg-slate-50 border border-transparent rounded-[1.5rem] text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Upload KK (Opsional)</label>
                                <input type="file" name="doc_kk" accept="image/*,.pdf"
                                    class="w-full px-4 py-4 bg-slate-50 border border-transparent rounded-[1.5rem] text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Upload NPWP (Opsional)</label>
                                <input type="file" name="doc_npwp" accept="image/*,.pdf"
                                    class="w-full px-4 py-4 bg-slate-50 border border-transparent rounded-[1.5rem] text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                            </div>
                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">KTP Penjamin (Opsional)</label>
                                <input type="file" name="doc_ktp_penjamin" accept="image/*,.pdf"
                                    class="w-full px-4 py-4 bg-slate-50 border border-transparent rounded-[1.5rem] text-sm text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Service Details Card -->
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-8">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Detail Layanan & Jadwal
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tipe
                                Layanan</label>
                            <select name="bookable_type" x-model="bookableType" @change="bookableId = ''"
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800 appearance-none">
                                <option value="Car">Mobil</option>
                                <option value="Motorcycle">Motor</option>
                                <option value="TourPackage">Paket Wisata</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Pilih
                                Unit/Paket</label>
                            <select name="bookable_id" x-model="bookableId" required
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800 appearance-none">
                                <option value="">-- Melalui Daftar --</option>
                                <template x-for="service in filteredServices" :key="service.id">
                                    <option :value="service.id" x-text="(service.brand ? service.brand + ' ' : '') + service.name + (service.transmission ? ' (' + service.transmission + ')' : '')"></option>
                                </template>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tanggal
                                Mulai</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800">
                        </div>
                        <div class="space-y-2" x-show="bookableType !== 'TourPackage'">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tanggal
                                Selesai</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800">
                        </div>
                    </div>
                </div>

                <!-- Notes Card -->
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-8">
                    <div class="flex items-center gap-4 mb-2">
                        <div class="w-10 h-10 bg-slate-50 rounded-xl flex items-center justify-center text-slate-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                            </svg>
                        </div>
                        <h3 class="text-xs font-black text-slate-800 uppercase tracking-[0.2em]">Catatan Tambahan</h3>
                    </div>

                    <div class="space-y-2">
                        <textarea name="notes" rows="6"
                            class="w-full px-8 py-5 bg-slate-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight text-slate-800 italic"
                            placeholder="Tuliskan catatan khusus atau detail transaksi manual ini...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Status & Submit -->
            <div class="space-y-10">
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 space-y-8 sticky top-32">
                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                            Awal</label>
                        <div class="grid grid-cols-1 gap-3">
                            @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                <label
                                    class="relative flex items-center p-5 border-2 rounded-3xl cursor-pointer transition-all duration-300 hover:border-slate-200">
                                    <input type="radio" name="status" value="{{ $status }}" class="sr-only"
                                        {{ old('status', 'pending') === $status ? 'checked' : '' }}>
                                    <div class="flex items-center gap-4 w-full">
                                        <div
                                            class="w-5 h-5 border-2 rounded-full border-slate-200 flex items-center justify-center peer-checked:border-amber-500 peer-checked:bg-amber-500 transition-all">
                                            <div
                                                class="w-2 h-2 rounded-full bg-white scale-0 transition-transform duration-300">
                                            </div>
                                        </div>
                                        <span
                                            class="text-xs font-black uppercase tracking-widest text-slate-600">{{ $status }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <button type="submit"
                            class="w-full py-6 bg-slate-900 text-white rounded-3xl font-black text-xs uppercase tracking-[0.2em] hover:bg-amber-500 transition-all duration-500 shadow-xl shadow-amber-950/20 active:scale-95">
                            Simpan Transaksi
                        </button>
                        <p class="text-[10px] text-slate-400 font-bold text-center mt-6 leading-relaxed italic">
                            * Total harga akan dikalkulasi secara otomatis oleh sistem berdasarkan durasi sewa.
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        input[type="radio"]:checked+div .w-2 {
            scale: 1;
        }

        input[type="radio"]:checked+div+span {
            color: #f59e0b;
        }

        label:has(input[type="radio"]:checked) {
            border-color: #f59e0b;
            background-color: #fffbeb;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
@endsection
