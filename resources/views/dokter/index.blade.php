@extends('layouts.admin')
@section('header', 'Daftar Dokter')
@section('content')
@if(session('success'))
    <div class="p-3 mb-4 bg-green-100 rounded text-green-800">{{ session('success') }}</div>
@endif
<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold text-gray-800">Daftar Dokter</h1>
    <a href="{{ route('dokter.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700">+ Tambah Dokter</a>
</div>
<div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full table-fixed">
        <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white">
                <th class="py-2 px-2 w-8">#</th>
                <th class="py-2 px-2 w-32">Nama</th>
                <th class="py-2 px-2 w-28">Spesialis</th>
                <th class="py-2 px-2 w-20">Telepon</th>
                <th class="py-2 px-2 w-36">Email</th>
                <th class="py-2 px-2 w-48">Alamat</th>
                <th class="py-2 px-2 w-16">Aktif</th>
                <th class="py-2 px-2 w-44">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach($doctors as $dok)
            <tr class="border-b hover:bg-gray-50">
                <td class="py-1 px-2 text-center">{{ $loop->iteration }}</td>
                <td class="py-1 px-2 font-semibold text-gray-700">{{ $dok->nama }}</td>
                <td class="py-1 px-2">{{ $dok->spesialis }}</td>
                <td class="py-1 px-2">{{ $dok->telepon }}</td>
                <td class="py-1 px-2">{{ $dok->email }}</td>
                <td class="py-1 px-2">{{ Str::limit($dok->alamat, 40) }}</td>
                <td class="py-1 px-2 text-center">
                    @if($dok->is_active)
                        <span class="px-2 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Aktif</span>
                    @else
                        <span class="px-2 py-1 rounded-full bg-gray-200 text-gray-700 text-xs font-semibold">Nonaktif</span>
                    @endif
                </td>
                <td class="py-1 px-1 whitespace-nowrap flex gap-1">
                    <a href="{{ route('dokter.show', $dok) }}" class="px-2 py-1 rounded bg-blue-100 text-blue-700 text-xs font-semibold">Detail</a>
                    <a href="{{ route('dokter.edit', $dok) }}" class="px-2 py-1 rounded bg-indigo-100 text-indigo-700 text-xs font-semibold">Edit</a>
                    <form action="{{ route('dokter.destroy', $dok) }}" method="POST" onsubmit="return confirm('Yakin hapus?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-2 py-1 rounded bg-red-100 text-red-700 text-xs font-semibold">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-2">{{ $doctors->links() }}</div>
@endsection
