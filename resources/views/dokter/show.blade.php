@extends('layouts.admin')
@section('header', 'Detail Dokter')
@section('content')

<div class="max-w-6xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">Dr. {{ $dokter->nama }}</h1>
                <p class="text-blue-100 mt-1">{{ $dokter->spesialis }}</p>
            </div>
            <div>
                @if($dokter->is_active)
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
    <div class="bg-white shadow-lg p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Spesialis</p>
                <p class="text-lg font-bold text-gray-800">{{ $dokter->spesialis }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Telepon</p>
                <p class="text-lg font-bold text-gray-800">{{ $dokter->telepon }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Email</p>
                <p class="text-lg font-bold text-gray-800">{{ $dokter->email }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <p class="text-xs text-gray-500 font-semibold uppercase mb-1">Total Kunjungan</p>
                <p class="text-lg font-bold text-blue-600">{{ $visits->total() }} Kunjungan</p>
            </div>
        </div>

        <!-- Alamat -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-5 mb-6">
            <h3 class="text-sm font-bold text-blue-800 uppercase mb-2">Alamat</h3>
            <p class="text-gray-700 leading-relaxed">{{ $dokter->alamat }}</p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-3 mb-8">
            <a href="{{ route('dokter.edit', $dokter) }}" 
               class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition shadow">
                ✏️ Edit Data
            </a>
            <form action="{{ route('dokter.destroy', $dokter) }}" method="POST" 
                  onsubmit="return confirm('Yakin hapus dokter {{ $dokter->nama }}?')" class="inline">
                @csrf @method('DELETE')
                <button type="submit" 
                        class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition shadow">
                    🗑️ Hapus
                </button>
            </form>
            <a href="{{ route('dokter.index') }}" 
               class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
                ← Kembali
            </a>
        </div>

        <!-- Daftar Kunjungan/Booking Pasien -->
        <div class="border-t pt-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-gray-800">📋 Riwayat Kunjungan Pasien</h2>
            </div>

            <!-- Form Filter Tanggal -->
            <div class="bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg p-5 mb-6">
                <form method="GET" action="{{ route('dokter.show', $dokter) }}" class="flex flex-wrap gap-4 items-end">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Mulai</label>
                        <input 
                            type="date" 
                            name="tanggal_mulai" 
                            value="{{ $tanggalMulai }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Selesai</label>
                        <input 
                            type="date" 
                            name="tanggal_selesai" 
                            value="{{ $tanggalSelesai }}"
                            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    <div class="flex gap-2">
                        <button 
                            type="submit" 
                            class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow">
                            🔍 Filter
                        </button>
                        <a 
                            href="{{ route('dokter.show', $dokter) }}" 
                            class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                            ↻ Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info Filter Aktif -->
            @if($tanggalMulai || $tanggalSelesai)
                <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                    <p class="text-sm text-yellow-800">
                        <strong>Filter Aktif:</strong> 
                        @if($tanggalMulai && $tanggalSelesai)
                            Menampilkan kunjungan dari {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }} 
                            sampai {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') }}
                        @elseif($tanggalMulai)
                            Menampilkan kunjungan sejak {{ \Carbon\Carbon::parse($tanggalMulai)->format('d M Y') }}
                        @elseif($tanggalSelesai)
                            Menampilkan kunjungan sampai {{ \Carbon\Carbon::parse($tanggalSelesai)->format('d M Y') }}
                        @endif
                    </p>
                </div>
            @endif
            
            @if($visits->count() > 0)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                                    <th class="py-3 px-4 text-left font-semibold text-sm">#</th>
                                    <th class="py-3 px-4 text-left font-semibold text-sm">Tanggal</th>
                                    <th class="py-3 px-4 text-left font-semibold text-sm">Pasien</th>
                                    <th class="py-3 px-4 text-left font-semibold text-sm">Layanan</th>
                                    <th class="py-3 px-4 text-left font-semibold text-sm">Keluhan</th>
                                    <th class="py-3 px-4 text-right font-semibold text-sm">Biaya</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($visits as $visit)
                                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                                    <td class="py-3 px-4 text-gray-600">{{ $loop->iteration }}</td>
                                    <td class="py-3 px-4 text-gray-700">
                                        {{ $visit->tanggal_kunjungan->format('d M Y') }}
                                        <span class="text-xs text-gray-500 block">
                                            {{ $visit->tanggal_kunjungan->format('H:i') }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">
                                        <span class="font-semibold text-gray-800">
                                            {{ $visit->patient->nama_hewan }}
                                        </span>
                                        <span class="text-xs text-gray-500 block">
                                            {{ $visit->patient->jenis_hewan }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-700">
                                        {{ $visit->service->nama_layanan }}
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">
                                        {{ Str::limit($visit->keluhan, 40) ?? '-' }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <span class="font-semibold text-blue-600">
                                            Rp {{ number_format($visit->total_biaya, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $visits->appends(['tanggal_mulai' => $tanggalMulai, 'tanggal_selesai' => $tanggalSelesai])->links() }}
                </div>
            @else
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
                    <p class="text-gray-500">
                        @if($tanggalMulai || $tanggalSelesai)
                            Tidak ada kunjungan pada rentang tanggal yang dipilih.
                        @else
                            Belum ada riwayat kunjungan pasien untuk dokter ini.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
