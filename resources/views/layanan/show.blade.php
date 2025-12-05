@extends('layouts.admin')
@section('header', 'Detail Layanan')
@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">{{ $layanan->nama_layanan }}</h1>
                <p class="text-blue-100 mt-1">{{ $layanan->kategori }}</p>
            </div>
            <div>
                @if($layanan->is_active)
                    <span class="px-4 py-2 rounded-full font-bold text-sm bg-green-400 text-green-900 shadow">
                        ✓ Aktif
                    </span>
                @else
                    <span class="px-4 py-2 rounded-full font-bold text-sm bg-gray-400 text-gray-900 shadow">
                        ✗ Nonaktif
                    </span>
                @endif
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white rounded-b-xl shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Harga</p>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Durasi</p>
                <p class="text-lg font-bold text-gray-800">{{ $layanan->durasi }} menit</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Kategori</p>
                <p class="text-lg font-bold text-gray-800">{{ $layanan->kategori }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Status</p>
                <p class="text-lg font-bold text-gray-800">{{ $layanan->is_active ? 'Aktif' : 'Nonaktif' }}</p>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mb-6">
            <h3 class="text-sm font-bold text-blue-800 uppercase mb-2">Deskripsi Layanan</h3>
            <p class="text-gray-700 leading-relaxed">{{ $layanan->deskripsi ?: 'Belum ada deskripsi.' }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('layanan.edit', $layanan) }}" 
               class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition shadow">
                ✏️ Edit Data
            </a>
            <form action="{{ route('layanan.destroy', $layanan) }}" method="POST" 
                  onsubmit="return confirm('Yakin hapus layanan {{ $layanan->nama_layanan }}?')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition shadow">
                    🗑️ Hapus
                </button>
            </form>
            <a href="{{ route('layanan.index') }}" 
               class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
                ← Kembali
            </a>
        </div>
    </div>
</div>

@endsection
