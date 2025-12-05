@extends('layouts.admin')
@section('header', 'Daftar Pasien')
@section('content')

<div class="max-w-7xl mx-auto px-4 py-6">
    <!-- Header & Button Tambah -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🐾 Daftar Pasien Hewan</h1>
        <a href="{{ route('pasien.create') }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition shadow-md">
            ➕ Tambah Pasien
        </a>
    </div>

    <!-- ✅ SEARCH & FILTER BOX (TAMBAHAN BARU) -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" action="{{ route('pasien.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search Box -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        🔍 Cari Pasien
                    </label>
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Nama hewan, pemilik, jenis, atau ras..."
                        class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filter Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        📊 Status
                    </label>
                    <select 
                        name="status" 
                        class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        @foreach($statusList as $s)
                            <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>
                                {{ $s }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Jenis Hewan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        🐾 Jenis Hewan
                    </label>
                    <input 
                        type="text" 
                        name="jenis_hewan" 
                        value="{{ request('jenis_hewan') }}" 
                        placeholder="Kucing, Anjing..."
                        class="w-full rounded-lg border border-gray-300 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <!-- Button Actions -->
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="px-5 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
                    🔍 Cari
                </button>
                <a 
                    href="{{ route('pasien.index') }}" 
                    class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition">
                    🔄 Reset
                </a>
            </div>

            <!-- Info Hasil Pencarian -->
            @if(request('search') || request('status') || request('jenis_hewan'))
                <div class="bg-blue-50 border-l-4 border-blue-500 text-blue-700 p-3 rounded">
                    <p class="text-sm font-semibold">
                        📊 Menampilkan {{ $patients->total() }} hasil
                        @if(request('search'))
                            untuk pencarian "<strong>{{ request('search') }}</strong>"
                        @endif
                        @if(request('status'))
                            dengan status <strong>{{ request('status') }}</strong>
                        @endif
                        @if(request('jenis_hewan'))
                            jenis <strong>{{ request('jenis_hewan') }}</strong>
                        @endif
                    </p>
                </div>
            @endif
        </form>
    </div>

    <!-- Notifikasi Success -->
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p class="font-semibold">✅ {{ session('success') }}</p>
        </div>
    @endif

    <!-- ✅ TABLE DAFTAR PASIEN (TETAP ADA, TIDAK DIHILANGKAN) -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Judul Perawatan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Pemilik</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nama Hewan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Jenis</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Ras</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Umur</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-center text-xs font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($patients as $index => $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $patients->firstItem() + $index }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $p->judul_perawatan ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        <div class="font-semibold">{{ $p->nama_pemilik ?? '-' }}</div>
                        @if($p->telepon_pemilik)
                            <div class="text-xs text-gray-500">📞 {{ $p->telepon_pemilik }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-gray-900">
                        {{ $p->nama_hewan }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $p->jenis_hewan }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $p->ras ?? '-' }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $p->umur_lengkap }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                        {{ $p->jenis_kelamin }}
                    </td>
                    <td class="px-6 py-4 text-sm">
                        @php
                            $statusColor = \App\Models\Patient::getStatusColor($p->status);
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-bold border-2 {{ $statusColor }}">
                            {{ $p->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('pasien.show', $p) }}" 
                               class="px-3 py-1.5 bg-blue-500 text-white rounded hover:bg-blue-600 transition text-xs font-semibold">
                                👁️ Detail
                            </a>
                            <a href="{{ route('pasien.edit', $p) }}" 
                               class="px-3 py-1.5 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition text-xs font-semibold">
                                ✏️ Edit
                            </a>
                            <form method="POST" action="{{ route('pasien.destroy', $p) }}" class="inline-block"
                                  onsubmit="return confirm('Yakin ingin menghapus pasien {{ $p->nama_hewan }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1.5 bg-red-500 text-white rounded hover:bg-red-600 transition text-xs font-semibold">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-6 py-8 text-center">
                        <div class="text-gray-400">
                            <svg class="w-16 h-16 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="text-lg font-semibold">Tidak ada data pasien</p>
                            @if(request('search') || request('status') || request('jenis_hewan'))
                                <p class="text-sm mt-2">Coba ubah filter pencarian Anda</p>
                            @else
                                <p class="text-sm mt-2">Klik tombol "Tambah Pasien" untuk menambahkan data baru</p>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $patients->appends(request()->query())->links() }}
    </div>
</div>

@endsection
