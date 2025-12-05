@extends('layouts.admin')
@section('header', 'Struk Perawatan Pasien')
@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Action Bar -->
    <div class="bg-white rounded-t-lg shadow-md p-4 flex justify-between items-center border-b">
        <a href="{{ route('pasien.show', $pasien) }}" 
           class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
            ← Kembali
        </a>
        <div class="flex gap-3">
            <!-- Button Print -->
            <button onclick="window.print()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                Print
            </button>
            
            <!-- Button Download PDF -->
            <a href="{{ route('pasien.struk.download', $pasien) }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download PDF
            </a>
        </div>
    </div>

    <!-- Preview Struk -->
    <div class="bg-white shadow-2xl rounded-b-lg p-8 print:shadow-none" id="struk-content">
        
        <!-- Header -->
        <div class="text-center border-b-4 border-blue-600 pb-6 mb-6">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">🐾 VETCARE CENTER</h1>
            <p class="text-gray-600 font-medium">Klinik Kesehatan Hewan Profesional</p>
            <p class="text-sm text-gray-500 mt-1">Jl. Contoh No. 123, Jember | Telp: (0331) 123456 | Email: info@vetcare.id</p>
        </div>

        <!-- Invoice Info -->
        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 mb-6 border-l-4 border-blue-600">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nomor Invoice:</p>
                    <p class="text-lg font-bold text-blue-600">{{ $invoiceNumber }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status Perawatan:</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800 border border-green-300">
                        {{ $pasien->status }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kunjungan Terakhir:</p>
                    <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Dicetak:</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $tanggalCetak }}</p>
                </div>
            </div>
        </div>

        <!-- Data Pasien -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center border-b-2 border-gray-200 pb-2">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                DATA PASIEN
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Nama Hewan:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->nama_hewan }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Jenis Hewan:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->jenis_hewan }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Ras:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->ras ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Umur:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->umur_lengkap }}</span>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Jenis Kelamin:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->jenis_kelamin }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Pemilik:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->nama_pemilik ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between border-b border-gray-100 pb-1">
                        <span class="text-gray-600 font-medium">Telepon:</span>
                        <span class="font-semibold text-gray-800">{{ $pasien->telepon_pemilik ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Judul Perawatan -->
        @if($pasien->judul_perawatan)
        <div class="mb-6 bg-purple-50 border-l-4 border-purple-500 rounded p-4">
            <p class="text-sm font-bold text-purple-800 mb-2">Judul Perawatan:</p>
            <p class="text-gray-700 font-semibold text-lg">{{ $pasien->judul_perawatan }}</p>
        </div>
        @endif

        <!-- Data Kunjungan Terakhir -->
        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center border-b-2 border-gray-200 pb-2">
                <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                DATA KUNJUNGAN TERAKHIR
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600 font-medium">Tanggal:</span>
                    <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600 font-medium">Dokter:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->doctor->nama }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600 font-medium">Layanan:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->service->nama_layanan }}</span>
                </div>
            </div>
        </div>

        <!-- Detail Medis -->
        <div class="space-y-4 mb-6">
            <div class="bg-blue-50 border-l-4 border-blue-500 rounded p-4">
                <p class="text-sm font-bold text-blue-800 mb-2">Keluhan:</p>
                <p class="text-gray-700">{{ $kunjungan->keluhan }}</p>
            </div>

            @if($kunjungan->diagnosis)
            <div class="bg-purple-50 border-l-4 border-purple-500 rounded p-4">
                <p class="text-sm font-bold text-purple-800 mb-2">Diagnosis:</p>
                <p class="text-gray-700">{{ $kunjungan->diagnosis }}</p>
            </div>
            @endif

            @if($kunjungan->tindakan)
            <div class="bg-green-50 border-l-4 border-green-500 rounded p-4">
                <p class="text-sm font-bold text-green-800 mb-2">Tindakan:</p>
                <p class="text-gray-700">{{ $kunjungan->tindakan }}</p>
            </div>
            @endif

            @if($kunjungan->catatan)
            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded p-4">
                <p class="text-sm font-bold text-yellow-800 mb-2">Catatan:</p>
                <p class="text-gray-700">{{ $kunjungan->catatan }}</p>
            </div>
            @endif
        </div>

        <!-- Total Biaya -->
        <div class="border-t-4 border-blue-600 pt-6">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg p-6 flex justify-between items-center">
                <span class="text-xl font-bold">TOTAL BIAYA PERAWATAN</span>
                <span class="text-3xl font-bold">Rp {{ number_format($kunjungan->total_biaya, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-700 font-semibold mb-2">Terima kasih atas kepercayaan Anda kepada VetCare Center</p>
            <p class="text-gray-600 text-sm">Semoga {{ $pasien->nama_hewan }} segera sehat kembali</p>
            <p class="text-gray-400 text-xs mt-4">Struk ini dicetak secara otomatis oleh sistem VetCare Center</p>
        </div>
    </div>
</div>

{{-- CSS untuk Print --}}
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #struk-content, #struk-content * {
        visibility: visible;
    }
    #struk-content {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .print\:shadow-none {
        box-shadow: none !important;
    }
}
</style>

@endsection
