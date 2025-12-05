@extends('layouts.admin')
@section('header', 'Daftar Dokter')
@section('content')

@if(session('success'))
    <div class="p-4 mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="mb-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Dokter</h1>
        <a href="{{ route('dokter.create') }}" 
           class="px-5 py-2.5 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition font-semibold">
            + Tambah Dokter
        </a>
    </div>
</div>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gradient-to-r from-blue-500 to-purple-600 text-white">
                    <th class="py-4 px-4 text-left font-semibold text-sm">#</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Nama</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Spesialis</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Telepon</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Email</th>
                    <th class="py-4 px-4 text-left font-semibold text-sm">Alamat</th>
                    <th class="py-4 px-4 text-center font-semibold text-sm">Status</th>
                    <th class="py-4 px-4 text-center font-semibold text-sm">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm">
                @forelse($doctors as $dok)
                <tr class="border-b border-gray-100 hover:bg-blue-50 transition">
                    <td class="py-4 px-4 text-gray-600">{{ $loop->iteration }}</td>
                    <td class="py-4 px-4">
                        <span class="font-semibold text-gray-800">{{ $dok->nama }}</span>
                    </td>
                    <td class="py-4 px-4 text-gray-700">{{ $dok->spesialis }}</td>
                    <td class="py-4 px-4 text-gray-700">{{ $dok->telepon }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ $dok->email }}</td>
                    <td class="py-4 px-4 text-gray-600">{{ Str::limit($dok->alamat, 30) }}</td>
                    <td class="py-4 px-4 text-center">
                        @if($dok->is_active)
                            <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-800 text-xs font-semibold border border-green-300">
                                Aktif
                            </span>
                        @else
                            <span class="inline-block px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-xs font-semibold border border-gray-300">
                                Nonaktif
                            </span>
                        @endif
                    </td>
                    <td class="py-4 px-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('dokter.show', $dok) }}" 
                               class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 text-xs font-semibold transition border border-blue-200">
                                Detail
                            </a>
                            <a href="{{ route('dokter.edit', $dok) }}" 
                               class="px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-lg hover:bg-indigo-100 text-xs font-semibold transition border border-indigo-200">
                                Edit
                            </a>
                            <form action="{{ route('dokter.destroy', $dok) }}" method="POST" 
                                  onsubmit="return confirm('Yakin hapus dokter {{ $dok->nama }}?')" 
                                  class="inline">
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
                    <td colspan="8" class="py-8 text-center text-gray-500">
                        Belum ada data dokter
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $doctors->links() }}
</div>

@endsection
