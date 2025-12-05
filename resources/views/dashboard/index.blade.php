@extends('layouts.admin')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Pasien -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium">Total Pasien</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalPatients }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Dokter -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium">Total Dokter</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalDoctors }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Layanan -->
        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-100 text-sm font-medium">Total Layanan</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalServices }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Kunjungan -->
        <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-pink-100 text-sm font-medium">Total Kunjungan</p>
                    <p class="text-3xl font-bold mt-2">{{ $totalVisits }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-full p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Perawatan Pasien</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-9 gap-4">
            @php
            $statuses = [
                'Booking',
                'Pemeriksaan',
                'Pra-Karantina',
                'Operasi',
                'Pasca-Karantina',
                'Rawat Jalan',
                'Kritis',      // ← TAMBAHKAN
                'Meninggal',   // ← TAMBAHKAN
                'Selesai',
                ];
            $colors = [
                'bg-yellow-100 text-yellow-800',
                'bg-blue-100 text-blue-800',
                'bg-orange-100 text-orange-800',
                'bg-red-100 text-red-800',
                'bg-purple-100 text-purple-800',
                'bg-indigo-100 text-indigo-800',
                'bg-red-200 text-red-900 border-2 border-red-400',     // ← KRITIS
                'bg-gray-800 text-white border-2 border-gray-900',     // ← MENINGGAL
                'bg-green-100 text-green-800',
            ];
            @endphp

<<<<<<< HEAD
            @foreach ($statuses as $index => $status)
=======
    <!-- Total Layanan -->
    <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-indigo-100 text-sm font-medium">Total Layanan</p>
                <p class="text-3xl font-bold mt-2">{{ $totalServices }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Kunjungan -->
    <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg shadow-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-pink-100 text-sm font-medium">Total Kunjungan</p>
                <p class="text-3xl font-bold mt-2">{{ $totalVisits }}</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Status Perawatan -->
<div class="bg-white rounded-lg shadow-md p-6 mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">Status Perawatan Pasien</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
        @php
            $statuses = ['Booking', 'Pemeriksaan', 'Pra-Karantina', 'Operasi', 'Pasca-Karantina', 'Rawat Jalan', 'Selesai'];
            $colors = ['bg-yellow-100 text-yellow-800', 'bg-blue-100 text-blue-800', 'bg-orange-100 text-orange-800', 'bg-red-100 text-red-800', 'bg-purple-100 text-purple-800', 'bg-indigo-100 text-indigo-800', 'bg-green-100 text-green-800'];
        @endphp

        @foreach($statuses as $index => $status)
>>>>>>> b4b93f475a880df4b5dd1e3d3fdbda7bfcf471eb
            <div class="text-center p-4 {{ $colors[$index] }} rounded-lg">
                <p class="text-2xl font-bold">{{ $statusStats[$status] ?? 0 }}</p>
                <p class="text-xs mt-1">{{ $status }}</p>
            </div>
        @endforeach
    </div>

<<<<<<< HEAD

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Pasien Terbaru -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Pasien Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentPatients as $patient)
                        <div
                            class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800">{{ $patient->nama_hewan }}</p>
                                <p class="text-sm text-gray-600">{{ $patient->jenis_hewan }} - {{ $patient->ras }}</p>
                            </div>
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full
                            @if ($patient->status == 'Booking') bg-yellow-100 text-yellow-800
                            @elseif($patient->status == 'Pemeriksaan') bg-blue-100 text-blue-800
                            @elseif($patient->status == 'Selesai') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                                {{ $patient->status }}
                            </span>
=======
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Pasien Terbaru -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800"> Pasien Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentPatients as $patient)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex-1">
                            <p class="font-semibold text-gray-800">{{ $patient->nama_hewan }}</p>
                            <p class="text-sm text-gray-600">{{ $patient->jenis_hewan }} - {{ $patient->ras }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full 
                            @if($patient->status == 'Booking') bg-yellow-100 text-yellow-800
                            @elseif($patient->status == 'Pemeriksaan') bg-blue-100 text-blue-800
                            @elseif($patient->status == 'Selesai') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ $patient->status }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Belum ada data pasien</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Kunjungan Terbaru -->
    <div class="bg-white rounded-lg shadow-md">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-800"> Kunjungan Terbaru</h3>
        </div>
        <div class="p-6">
            <div class="space-y-4">
                @forelse($recentVisits as $visit)
                    <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <div class="flex items-start justify-between mb-2">
                            <p class="font-semibold text-gray-800">{{ $visit->patient->nama_hewan }}</p>
                            <span class="text-xs text-gray-500">{{ $visit->tanggal_kunjungan->format('d M Y') }}</span>
>>>>>>> b4b93f475a880df4b5dd1e3d3fdbda7bfcf471eb
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data pasien</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Kunjungan Terbaru -->
        <div class="bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Kunjungan Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($recentVisits as $visit)
                        <div class="p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <div class="flex items-start justify-between mb-2">
                                <p class="font-semibold text-gray-800">{{ $visit->patient->nama_hewan }}</p>
                                <span class="text-xs text-gray-500">{{ $visit->tanggal_kunjungan->format('d M Y') }}</span>
                            </div>
                            <p class="text-sm text-gray-600">Dr. {{ $visit->doctor->nama }}</p>
                            <p class="text-sm text-gray-500">{{ $visit->service->nama_layanan }}</p>
                            <p class="text-sm font-semibold text-blue-600 mt-2">Rp
                                {{ number_format($visit->total_biaya, 0, ',', '.') }}</p>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">Belum ada data kunjungan</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
