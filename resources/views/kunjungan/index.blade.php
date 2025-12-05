@extends('layouts.admin')
@section('header', 'Daftar Kunjungan')
@section('content')

@if(session('success'))
    <div class="p-4 mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kunjungan</h1>
        <a href="{{ route('kunjungan.create') }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition font-semibold">
            + Tambah Kunjungan
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <th class="py-4 px-4 text-left font-semibold text-sm">#</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Tanggal</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Pasien</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Dokter</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Layanan</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Keluhan</th>
                    <th class="py-4 px-4 text-right font-semibold text-sm">Biaya</th>
                    <th class="py-4 px-4 text-center font-semibold text-sm">Status</th>
                    <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($visits as $visit)
                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                    <td class="py-4 px-4 text-gray-600">{{ $loop->iteration }}</td>
                    <td class="py-4 px-4">
                        <span class="font-semibold text-gray-800">{{ $visit->tanggal_kunjungan->format('d M Y') }}</span>
                        <span class="text-xs text-gray-500 block">{{ $visit->tanggal_kunjungan->format('H:i') }}</span>
                    </td>
                    <td class="py-4 px-4">
                        <span class="font-semibold text-gray-800">{{ $visit->patient->nama_hewan }}</span>
                        <span class="text-xs text-gray-500 block">{{ $visit->patient->jenis_hewan }}</span>
                    </td>
                    <td class="py-4 px-4 text-gray-700">Dr. {{ $visit->doctor->nama }}</td>
                    <td class="py-4 px-4 text-gray-700">{{ $visit->service->nama_layanan }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ Str::limit($visit->keluhan, 30) ?? '-' }}</td>
                    <td class="py-4 px-4 text-right">
                        <span class="font-semibold text-blue-600">
                            Rp {{ number_format($visit->total_biaya, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="py-4 px-4 text-center">
                        @php
                            $statusColor = match($visit->status_visit) {
                                'Scheduled' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                'In Progress' => 'bg-blue-100 text-blue-800 border-blue-300',
                                'Completed' => 'bg-green-100 text-green-800 border-green-300',
                                'Cancelled' => 'bg-red-100 text-red-800 border-red-300',
                                default => 'bg-gray-100 text-gray-800 border-gray-300',
                            };
                        @endphp
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold border {{ $statusColor }}">
                            {{ $visit->status_visit }}
                        </span>
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('kunjungan.show', $visit) }}" 
                               class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 text-xs font-semibold transition border border-blue-200">
                                Detail
                            </a>
                            <a href="{{ route('kunjungan.edit', $visit) }}" 
                               class="px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 text-xs font-semibold transition border border-indigo-200">
                                Edit
                            </a>
                            <form action="{{ route('kunjungan.destroy', $visit) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus kunjungan ini?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="px-3 py-1.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 text-xs font-semibold transition border border-red-200">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="py-8 text-center text-gray-500">
                        Belum ada data kunjungan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $visits->links() }}
</div>

@endsection
