{{--
    Komponen Persyaratan Rental
    Digunakan di semua form booking (modal maupun inline).
    Parameter opsional $compact (boolean) untuk tampilan modal yang lebih ringkas.
--}}
@props(['compact' => false])

@php $inputClass = $compact
    ? 'w-full pl-10 pr-4 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-xs tracking-tight text-slate-900 placeholder-slate-400'
    : 'w-full rounded-lg border border-slate-200 bg-slate-50 px-4 py-3 text-base text-slate-900 placeholder:text-slate-300 transition-all focus:border-amber-400 focus:outline-none focus:ring-2 focus:ring-amber-400/30';
$labelClass = $compact
    ? 'text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2'
    : 'pl-1 text-sm font-medium text-slate-600';
$fileClass = $compact
    ? 'w-full text-xs text-slate-700 font-bold file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-wider file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer bg-slate-50/50 border border-slate-100 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] transition-all'
    : 'w-full text-sm text-slate-700 font-bold file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-black file:uppercase file:tracking-wider file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 cursor-pointer bg-slate-50 border border-slate-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-400/30 transition-all';
@endphp

{{-- ── SEPARATOR ── --}}
<div class="{{ $compact ? 'pt-4 border-t border-slate-100' : 'pt-2 border-t border-slate-100 col-span-1 md:col-span-2' }}">
    <div class="{{ $compact ? 'flex items-center gap-2 mb-4' : 'flex items-center gap-3 mb-5' }}">
        <div class="{{ $compact ? 'w-6 h-6 rounded-lg bg-amber-50 flex items-center justify-center' : 'w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center' }}">
            <i class="fa-solid fa-id-card text-[#D4AF37] {{ $compact ? 'text-[10px]' : 'text-sm' }}"></i>
        </div>
        <div>
            <p class="{{ $compact ? 'text-[10px] font-black text-slate-800 uppercase tracking-widest leading-none' : 'text-sm font-black text-slate-800 uppercase tracking-widest leading-none' }}">
                Persyaratan Rental
            </p>
            <p class="{{ $compact ? 'text-[9px] text-slate-400 font-medium mt-0.5' : 'text-xs text-slate-400 font-medium mt-1' }}">
                Opsional — dapat dikirim WhatsApp jika belum siap
            </p>
        </div>
    </div>
</div>

{{-- ── KONTAK DARURAT ── --}}
<div class="{{ $compact ? 'space-y-1.5' : 'space-y-2' }}">
    <label class="{{ $labelClass }}">No. Darurat</label>
    <div class="relative group/input">
        @if($compact)
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
            <i class="fa-solid fa-phone-volume text-xs"></i>
        </div>
        @endif
        <input type="tel" name="emergency_contact_phone"
            value="{{ old('emergency_contact_phone') }}"
            class="{{ $inputClass }} {{ $compact ? 'pl-10' : '' }}"
            placeholder="{{ $compact ? 'No. HP Kontak Darurat' : 'Nomor HP yang bisa dihubungi' }}">
    </div>
    @error('emergency_contact_phone')
        <p class="{{ $compact ? 'text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider' : 'text-red-500 text-xs mt-1 pl-1' }}">{{ $message }}</p>
    @enderror
</div>

{{-- ── HUBUNGAN PENJAMIN ── --}}
<div class="{{ $compact ? 'space-y-1.5' : 'space-y-2' }}">
    <label class="{{ $labelClass }}">Hubungan / Penjamin</label>
    <div class="relative group/input">
        @if($compact)
        <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
            <i class="fa-solid fa-user-tie text-xs"></i>
        </div>
        @endif
        <input type="text" name="emergency_contact_relation"
            value="{{ old('emergency_contact_relation') }}"
            class="{{ $inputClass }} {{ $compact ? 'pl-10' : '' }}"
            placeholder="{{ $compact ? 'Misal: Istri, Orang Tua' : 'Contoh: Istri, Orang Tua, Teman' }}">
    </div>
    @error('emergency_contact_relation')
        <p class="{{ $compact ? 'text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider' : 'text-red-500 text-xs mt-1 pl-1' }}">{{ $message }}</p>
    @enderror
</div>

{{-- ── UPLOAD DOCS ── --}}
@php
$docs = [
    ['field' => 'doc_ktp', 'label' => 'Foto KTP Penyewa', 'icon' => 'fa-id-card'],
    ['field' => 'doc_kk', 'label' => 'Foto KK (Kartu Keluarga)', 'icon' => 'fa-users'],
    ['field' => 'doc_npwp', 'label' => 'NPWP (Opsional)', 'icon' => 'fa-file-invoice'],
    ['field' => 'doc_ktp_penjamin', 'label' => 'KTP Penjamin', 'icon' => 'fa-user-shield'],
];
@endphp

@foreach($docs as $doc)
<div class="{{ $compact ? 'space-y-1.5' : 'space-y-2' }}">
    <label class="{{ $labelClass }}">
        <i class="fa-solid {{ $doc['icon'] }} mr-1 text-amber-500"></i>
        {{ $doc['label'] }}
    </label>
    <input type="file" name="{{ $doc['field'] }}"
        accept=".jpg,.jpeg,.png,.pdf"
        class="{{ $fileClass }}">
    @error($doc['field'])
        <p class="{{ $compact ? 'text-red-500 text-[10px] font-bold mt-1 ml-2 uppercase tracking-wider' : 'text-red-500 text-xs mt-1 pl-1' }}">{{ $message }}</p>
    @enderror
</div>
@endforeach

{{-- Info Note --}}
<div class="{{ $compact ? 'col-span-1' : 'col-span-1 md:col-span-2' }}">
    <div class="flex items-start gap-2.5 p-3 bg-amber-50 rounded-xl border border-amber-100">
        <i class="fa-solid fa-circle-info text-amber-500 text-xs mt-0.5 shrink-0"></i>
        <p class="text-[10px] text-amber-700 font-bold leading-relaxed">
            Format: JPG, PNG, atau PDF. Maks 5MB per file. Dokumen aman & hanya digunakan untuk verifikasi admin.
        </p>
    </div>
</div>
