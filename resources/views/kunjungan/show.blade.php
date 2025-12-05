@extends('layouts.admin')
@section('header', 'Detail Kunjungan')
@section('content')

<div class="max-w-5xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Kunjungan #{{ $kunjungan->id }}</h1>
                <p class="text-blue-100 mt-1">{{ $kunjungan->tanggal_kunjungan->format('d F Y, H:i') }} WIB</p>
            </div>
            <div>
                @php
                    $statusColor = match($kunjungan->status_visit) {
                        'Scheduled' => 'bg-yellow-400 text-yellow-900',
                        'In Progress' => 'bg-blue-400 text-blue-900',
                        'Completed' => 'bg-green-400 text-green-900',
                        'Cancelled' => 'bg-red-400 text-red-900',
                        default => 'bg-gray-400 text-gray-900',
                    };
                @endphp
                <span class="px-4 py-2 rounded-full font-bold text-sm {{ $statusColor }} shadow">
                    {{ $kunjungan->status_visit }}
                </span>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white rounded-b-xl shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-blue-50 p-5 rounded-lg border border-blue-200">
                <p class="text-xs text-blue-600 font-semibold uppercase mb-2">Pasien</p>
                <p class="text-xl font-bold text-gray-800">{{ $kunjungan->patient->nama_hewan }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $kunjungan->patient->jenis_hewan }} • {{ $kunjungan->patient->ras }}</p>
            </div>
            
            <div class="bg-purple-50 p-5 rounded-lg border border-purple-200">
                <p class="text-xs text-purple-600 font-semibold uppercase mb-2">Dokter</p>
                <p class="text-xl font-bold text-gray-800">Dr. {{ $kunjungan->doctor->nama }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $kunjungan->doctor->spesialis }}</p>
            </div>
            
            <div class="bg-indigo-50 p-5 rounded-lg border border-indigo-200">
                <p class="text-xs text-indigo-600 font-semibold uppercase mb-2">Layanan</p>
                <p class="text-xl font-bold text-gray-800">{{ $kunjungan->service->nama_layanan }}</p>
                <p class="text-sm text-gray-600 mt-1">{{ $kunjungan->service->kategori }}</p>
            </div>
        </div>

        <!-- Detail Kunjungan -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Keluhan</p>
                <p class="text-gray-700 leading-relaxed">{{ $kunjungan->keluhan ?? '-' }}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Diagnosis</p>
                <p class="text-gray-700 leading-relaxed">{{ $kunjungan->diagnosis ?? '-' }}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Tindakan</p>
                <p class="text-gray-700 leading-relaxed">{{ $kunjungan->tindakan ?? '-' }}</p>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Catatan</p>
                <p class="text-gray-700 leading-relaxed">{{ $kunjungan->catatan ?? '-' }}</p>
            </div>
        </div>

        <!-- Total Biaya -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-6">
            <div class="flex items-center justify-between">
                <span class="text-lg font-semibold text-green-800">Total Biaya</span>
                <span class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($kunjungan->total_biaya, 0, ',', '.') }}
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white rounded-b-xl shadow-md p-6 mt-6 flex justify-between items-center">
    <a href="{{ route('kunjungan.index') }}" 
       class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
        ← Kembali
    </a>
    <div class="flex gap-3">
        {{-- ✅ BUTTON CETAK STRUK (hanya jika status Completed) --}}
        @if($kunjungan->status === 'Completed')
            <a href="{{ route('kunjungan.struk', $kunjungan) }}" 
               class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-md flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Cetak Struk
            </a>
        @endif
        
        <a href="{{ route('kunjungan.edit', $kunjungan) }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
            ✏️ Edit
        </a>
        
        <form method="POST" action="{{ route('kunjungan.destroy', $kunjungan) }}" class="inline-block"
              onsubmit="return confirm('Yakin ingin menghapus kunjungan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                🗑️ Hapus
            </button>
        </form>
    </div>
</div>
    </div>
</div>

@endsection
