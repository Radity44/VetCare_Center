@extends('layouts.admin')
@section('header', 'Detail Pasien')
@section('content')

<div class="max-w-4xl mx-auto">
    <!-- Header Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-t-xl shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold">{{ $pasien->nama_hewan }}</h1>
                <p class="text-blue-100 mt-1">{{ $pasien->jenis_hewan }} - {{ $pasien->ras ?? 'Ras tidak diketahui' }}</p>
            </div>
            <div class="text-right">
                @php
                    $statusColor = \App\Models\Patient::getStatusColor($pasien->status);
                @endphp
                <span class="inline-block px-4 py-2 rounded-full text-sm font-bold border-2 {{ $statusColor }}">
                    {{ $pasien->status }}
                </span>
            </div>
        </div>
    </div>

    <!-- Info Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Data Hewan -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Data Hewan
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Nama</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->nama_hewan }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Jenis</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->jenis_hewan }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Ras</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->ras ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Tanggal Lahir</span>
                    <span class="font-semibold text-gray-800">
                        {{ $pasien->tanggal_lahir ? $pasien->tanggal_lahir->format('d/m/Y') : '-' }}
                    </span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Umur</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->umur_lengkap }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Jenis Kelamin</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->jenis_kelamin }}</span>
                </div>
            </div>
        </div>

        <!-- Data Pemilik -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Data Pemilik
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Nama</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->nama_pemilik ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-gray-100 pb-2">
                    <span class="text-gray-600">Telepon</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->telepon_pemilik ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Alamat</span>
                    <span class="font-semibold text-gray-800">{{ $pasien->alamat_pemilik ?? '-' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Judul Perawatan -->
    @if($pasien->judul_perawatan)
    <div class="bg-gradient-to-r from-purple-50 to-blue-50 rounded-lg shadow-md p-6 mt-6 border-l-4 border-purple-500">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Judul Perawatan
        </h3>
        <p class="text-gray-700 text-lg font-semibold">{{ $pasien->judul_perawatan }}</p>
    </div>
    @endif

    <!-- Riwayat Perawatan -->
    @if($pasien->riwayat_perawatan)
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
            <svg class="w-5 h-5 mr-2 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Riwayat Perawatan
        </h3>
        <p class="text-gray-700 whitespace-pre-line">{{ $pasien->riwayat_perawatan }}</p>
    </div>
    @endif


     <!-- Riwayat Kunjungan -->
<div class="bg-white rounded-lg shadow-md p-6 mt-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
        </svg>
        Riwayat Kunjungan
    </h3>

    {{-- ✅ DEBUGGING: Tampilkan jumlah kunjungan --}}
    <p class="text-xs text-gray-500 mb-2">Total kunjungan: {{ $pasien->visits->count() }}</p>

    @if($pasien->visits->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">TANGGAL</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">DOKTER</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">LAYANAN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">KELUHAN</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">DIAGNOSIS</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">STATUS</th>
                        <th class="px-4 py-3 text-left text-xs font-medium uppercase">BIAYA</th>
                        <th class="px-4 py-3 text-center text-xs font-medium uppercase">AKSI</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($pasien->visits as $visit)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ \Carbon\Carbon::parse($visit->tanggal_kunjungan)->format('d/m/Y') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $visit->doctor->nama ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-900">
                            {{ $visit->service->nama_layanan ?? '-' }}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            <div class="max-w-xs truncate" title="{{ $visit->keluhan }}">
                                {{ Str::limit($visit->keluhan, 30) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">
                            <div class="max-w-xs truncate" title="{{ $visit->diagnosis }}">
                                {{ Str::limit($visit->diagnosis ?? '-', 30) }}
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @php
                                $badgeColor = match($visit->status) {
                                    'Scheduled' => 'bg-blue-100 text-blue-800 border border-blue-300',
                                    'In Progress' => 'bg-yellow-100 text-yellow-800 border border-yellow-300',
                                    'Completed' => 'bg-green-100 text-green-800 border border-green-300',
                                    'Cancelled' => 'bg-red-100 text-red-800 border border-red-300',
                                    default => 'bg-gray-100 text-gray-800 border border-gray-300',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                {{ $visit->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm font-semibold text-green-600">
                            Rp {{ number_format($visit->total_biaya, 0, ',', '.') }}
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            @if($visit->status === 'Completed' || $pasien->status === 'Selesai')
                                <a href="{{ route('kunjungan.struk', $visit) }}" 
                                   class="inline-flex items-center justify-center w-10 h-10 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition shadow-sm"
                                   title="Lihat Struk Kunjungan">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </a>
                            @else
                                <span class="text-xs text-gray-400">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Summary -->
        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
            <p class="text-sm text-gray-600">
                <span class="font-semibold">Total Kunjungan:</span> {{ $pasien->visits->count() }} kali
            </p>
            <p class="text-sm text-gray-600">
                <span class="font-semibold">Total Biaya:</span> 
                <span class="text-lg font-bold text-purple-600">
                    Rp {{ number_format($pasien->visits->sum('total_biaya'), 0, ',', '.') }}
                </span>
            </p>
        </div>
    @else
        <div class="text-center py-8">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-500 font-medium">Belum ada riwayat kunjungan</p>
            <p class="text-sm text-gray-400 mt-1">Pasien ini belum pernah melakukan kunjungan ke klinik</p>
        </div>
    @endif
</div>



    <!-- Action Buttons -->
     <div class="bg-white rounded-b-xl shadow-md p-6 mt-6 flex justify-between items-center">
    <a href="{{ route('pasien.index') }}" 
       class="px-5 py-2.5 bg-gray-200 text-gray-800 rounded-lg font-semibold hover:bg-gray-300 transition">
        ← Kembali
    </a>
    <div class="flex gap-3">
        <!-- Button: Buat Kunjungan Baru -->
        <a href="{{ route('kunjungan.create', ['patient_id' => $pasien->id]) }}" 
           class="px-5 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition shadow-md flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Kunjungan Baru
        </a>
        
        <!-- Button: Edit Data -->
        <a href="{{ route('pasien.edit', $pasien) }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
            ✏️ Edit Data
        </a>
        
        <!-- Button: Hapus -->
        <form method="POST" action="{{ route('pasien.destroy', $pasien) }}" class="inline-block"
              onsubmit="return confirm('Yakin ingin menghapus pasien {{ $pasien->nama_hewan }}?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-5 py-2.5 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                🗑️ Hapus
            </button>
        </form>
    </div>
</div>
</div>

@endsection
