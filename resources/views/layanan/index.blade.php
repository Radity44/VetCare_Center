@extends('layouts.admin')
@section('header', 'Daftar Layanan')
@section('content')
@if(session('success'))
    <div class="p-3 mb-4 bg-green-100 rounded text-green-800">{{ session('success') }}</div>
@endif
<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold text-gray-800">Daftar Layanan</h1>
    <a href="{{ route('layanan.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ Tambah Layanan</a>
</div>
<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full table-fixed">
        <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                <th class="py-2 px-2 w-8">#</th>
                <th class="py-2 px-2 w-40">Nama</th>
                <th class="py-2 px-2 w-36">Deskripsi</th>
                <th class="py-2 px-2 w-16">Harga</th>
                <th class="py-2 px-2 w-24">Kategori</th>
                <th class="py-2 px-2 w-16">Durasi</th>
                <th class="py-2 px-2 w-16">Aktif</th>
                <th class="py-2 px-2 w-36">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach($services as $srv)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-1 px-2 text-center">{{ $loop->iteration }}</td>
                <td class="py-1 px-2 font-semibold text-gray-700">{{ $srv->nama_layanan }}</td>
                <td class="py-1 px-2">{{ Str::limit($srv->deskripsi, 40) }}</td>
                <td class="py-1 px-2 text-right">Rp {{ number_format($srv->harga, 0, ',', '.') }}</td>
                <td class="py-1 px-2">{{ $srv->kategori }}</td>
                <td class="py-1 px-2 text-center">{{ $srv->durasi }} menit</td>
                <td class="py-1 px-2 text-center">
                    @if($srv->is_active)
                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Aktif</span>
                    @else
                        <span class="px-2 py-1 rounded-full bg-gray-200 text-gray-700 text-xs font-semibold">Nonaktif</span>
                    @endif
                </td>
                <td class="py-1 px-2 whitespace-nowrap flex gap-1">
                    <a href="{{ route('layanan.show', $srv) }}" class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">Detail</a>
                    <a href="{{ route('layanan.edit', $srv) }}" class="px-2 py-1 rounded bg-indigo-100 text-indigo-700 text-xs font-semibold">Edit</a>
                    <form action="{{ route('layanan.destroy', $srv) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-semibold">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-2">{{ $services->links() }}</div>
@endsection
