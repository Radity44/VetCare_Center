@extends('layouts.admin')
@section('header', 'Detail Layanan')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="font-bold text-lg mb-2 text-blue-700">{{ $layanan->nama_layanan }}</h2>
    <div class="space-y-1 text-gray-700 text-sm mb-2">
        <div><strong>Deskripsi:</strong> {{ $layanan->deskripsi }}</div>
        <div><strong>Harga:</strong> Rp {{ number_format($layanan->harga, 0, ',', '.') }}</div>
        <div><strong>Kategori:</strong> {{ $layanan->kategori }}</div>
        <div><strong>Durasi:</strong> {{ $layanan->durasi }} menit</div>
        <div>
            <strong>Status:</strong>
            @if($layanan->is_active)
                <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Aktif</span>
            @else
                <span class="px-2 py-1 rounded-full bg-gray-200 text-gray-700 text-xs font-semibold">Nonaktif</span>
            @endif
        </div>
    </div>
    <div class="flex gap-2 mt-4">
        <a href="{{ route('layanan.edit', $layanan) }}" class="px-4 py-2 bg-indigo-100 text-indigo-700 rounded font-semibold">Edit</a>
        <form action="{{ route('layanan.destroy', $layanan) }}" method="POST" onsubmit="return confirm('Yakin hapus layanan ini?')" class="inline">
            @csrf @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-100 text-red-700 rounded font-semibold">Hapus</button>
        </form>
        <a href="{{ route('layanan.index') }}" class="px-4 py-2 bg-gray-100 text-gray-900 rounded hover:bg-gray-200 font-semibold">Kembali</a>
    </div>
</div>
@endsection
