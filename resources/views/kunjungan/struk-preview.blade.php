@extends('layouts.admin')
@section('header', 'Struk Kunjungan')
@section('content')

<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-t-lg shadow-md p-4 flex justify-between items-center border-b">
        <a href="{{ url()->previous() }}" 
           class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
            ← Kembali
        </a>
        <div class="flex gap-3">
            <button onclick="window.print()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                Print
            </button>
            
            <a href="{{ route('kunjungan.struk.download', $kunjungan) }}" 
               class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2">
                Download PDF
            </a>
        </div>
    </div>

    <div class="bg-white shadow-2xl rounded-b-lg p-8">
        <div class="text-center border-b-4 border-blue-600 pb-6 mb-6">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">🐾 VETCARE CENTER</h1>
            <p class="text-gray-600 font-medium">Klinik Kesehatan Hewan Profesional</p>
            <p class="text-sm text-gray-500 mt-1">Jl. Contoh No. 123, Jember | Telp: (0331) 123456</p>
        </div>

        <div class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-lg p-6 mb-6 border-l-4 border-blue-600">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Nomor Invoice:</p>
                    <p class="text-lg font-bold text-blue-600">{{ $invoiceNumber }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Kunjungan:</p>
                    <p class="text-lg font-bold text-gray-800">{{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status:</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-bold bg-green-100 text-green-800">
                        {{ $kunjungan->status }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Dicetak:</p>
                    <p class="text-sm font-semibold text-gray-700">{{ $tanggalCetak }}</p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 border-b-2 border-gray-200 pb-2">DATA PASIEN</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-600 font-medium">Nama Hewan:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->patient->nama_hewan }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-600 font-medium">Jenis:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->patient->jenis_hewan }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-600 font-medium">Pemilik:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->patient->nama_pemilik ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-1">
                    <span class="text-gray-600 font-medium">Telepon:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->patient->telepon_pemilik ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-3 border-b-2 border-gray-200 pb-2">DATA MEDIS</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600 font-medium">Dokter:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->doctor->nama }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600 font-medium">Layanan:</span>
                    <span class="font-semibold text-gray-800">{{ $kunjungan->service->nama_layanan }}</span>
                </div>
            </div>

            <div class="space-y-4">
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
        </div>

        <div class="border-t-4 border-blue-600 pt-6">
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-lg p-6 flex justify-between items-center">
                <span class="text-xl font-bold">TOTAL BIAYA</span>
                <span class="text-3xl font-bold">Rp {{ number_format($kunjungan->total_biaya, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="text-center mt-8 pt-6 border-t border-gray-200">
            <p class="text-gray-700 font-semibold mb-2">Terima kasih atas kepercayaan Anda kepada VetCare Center</p>
            <p class="text-gray-600 text-sm">Semoga hewan kesayangan Anda segera sehat kembali</p>
        </div>
    </div>
</div>

@endsection
