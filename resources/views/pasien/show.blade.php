@extends('layouts.admin')
@section('header', 'Detail Pasien')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <div class="flex items-center justify-between mb-2">
        <h2 class="font-bold text-xl text-blue-700">{{ $pasien->nama_hewan }}</h2>
        <span class="px-3 py-1 rounded-full text-xs font-semibold
           @if($pasien->status == 'Booking') bg-yellow-100 text-yellow-800
           @elseif($pasien->status == 'Pemeriksaan') bg-blue-100 text-blue-800
           @elseif($pasien->status == 'Pra-Karantina') bg-orange-100 text-orange-800
           @elseif($pasien->status == 'Operasi') bg-red-100 text-red-800
           @elseif($pasien->status == 'Pasca-Karantina') bg-purple-100 text-purple-800
           @elseif($pasien->status == 'Rawat Jalan') bg-indigo-100 text-indigo-800
           @elseif($pasien->status == 'Selesai') bg-green-100 text-green-800
           @else bg-gray-100 text-gray-800 @endif">
           {{ $pasien->status }}
        </span>
    </div>
    <div class="space-y-2 text-gray-700 text-sm mb-2">
        <div><strong>Jenis Hewan:</strong> {{ $pasien->jenis_hewan }}</div>
        <div><strong>Ras:</strong> {{ $pasien->ras }}</div>
        <div><strong>Umur:</strong> {{ $pasien->umur_hewan }} tahun</div>
        <div><strong>Jenis Kelamin:</strong> {{ $pasien->jenis_kelamin }}</div>
        <div><strong>Riwayat Perawatan:</strong><br>
            <span class="block p-2 bg-gray-50 rounded">{{ $pasien->riwayat_perawatan ?: '-' }}</span>
        </div>
    </div>
    <div class="flex gap-2 mt-4">
        <a href="{{ route('pasien.edit', $pasien) }}" class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded font-semibold hover:bg-indigo-200">Edit Data</a>
        <a href="{{ route('pasien.editStatus', $pasien) }}" class="px-4 py-2 bg-yellow-100 text-yellow-700 rounded font-semibold hover:bg-yellow-200">Update Status</a>
        <form action="{{ route('pasien.destroy', $pasien) }}" method="POST" onsubmit="return confirm('Yakin hapus pasien ini?')" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded font-semibold hover:bg-red-200">Hapus</button>
        </form>
        <a href="{{ route('pasien.index') }}" class="px-4 py-2 bg-gray-100 text-gray-900 rounded hover:bg-gray-200 font-semibold">Kembali</a>
    </div>
</div>
@endsection
