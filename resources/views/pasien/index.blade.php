@extends('layouts.admin')
@section('header', 'Daftar Pasien')
@section('content')
@if(session('success'))
    <div class="p-3 mb-4 bg-green-100 rounded text-green-800">{{ session('success') }}</div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-xl font-bold text-gray-800">Daftar Pasien</h1>
    <a href="{{ route('pasien.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded shadow hover:bg-blue-700 transition">+ Tambah Pasien</a>
</div>

<div class="overflow-x-auto bg-white shadow rounded-lg">
    <table class="min-w-full table-fixed">
        <thead>
            <tr class="bg-gradient-to-r from-blue-500 to-purple-500 text-white text-sm">
                <th class="py-2 px-1 w-8">#</th>
                <th class="py-2 px-1 w-32">Nama Hewan</th>
                <th class="py-2 px-1 w-24">Jenis</th>
                <th class="py-2 px-1 w-28">Ras</th>
                <th class="py-2 px-1 w-16">Umur</th>
                <th class="py-2 px-1 w-24">Status</th>
                <th class="py-2 px-1 w-32">Riwayat Perawatan</th>
                <th class="py-2 px-1 w-44">Action</th>
            </tr>
        </thead>
        <tbody class="text-sm">
            @foreach($patients as $p)
            <tr class="border-b hover:bg-gray-50 group">
                <td class="py-1 px-1 text-center">{{ $loop->iteration }}</td>
                <td class="py-1 px-1 font-semibold text-gray-700">{{ $p->nama_hewan }}</td>
                <td class="py-1 px-1">{{ $p->jenis_hewan }}</td>
                <td class="py-1 px-1">{{ $p->ras }}</td>
                <td class="py-1 px-1 text-center">{{ $p->umur_hewan }} th</td>
                <td class="py-1 px-1">
                    @php
                        $color = match($p->status) {
                            'Booking' => 'bg-yellow-100 text-yellow-800',
                            'Pemeriksaan' => 'bg-blue-100 text-blue-800',
                            'Pra-Karantina' => 'bg-orange-100 text-orange-800',
                            'Operasi' => 'bg-red-100 text-red-800',
                            'Pasca-Karantina' => 'bg-purple-100 text-purple-800',
                            'Rawat Jalan' => 'bg-indigo-100 text-indigo-800',
                            'Selesai' => 'bg-green-100 text-green-800',
                            default => 'bg-gray-100 text-gray-800',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $color }}">
                        {{ $p->status }}
                    </span>
                </td>
                <td class="py-1 px-1">
                    <div class="truncate text-gray-500 text-xs max-w-[120px]">
                        {{ Str::limit($p->riwayat_perawatan, 40, '...') }}
                    </div>
                </td>
                <td class="py-1 px-1 whitespace-nowrap space-x-1 flex flex-wrap items-center">
                    <a href="{{ route('pasien.show', $p) }}" class="px-2 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 text-xs font-semibold transition">Detail</a>
                    <a href="{{ route('pasien.edit', $p) }}" class="px-2 py-1 rounded bg-indigo-100 text-indigo-700 hover:bg-indigo-200 text-xs font-semibold transition">Edit</a>
                    <a href="{{ route('pasien.editStatus', $p) }}" class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-xs font-semibold transition">Status</a>
                    <form action="{{ route('pasien.destroy', $p) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-2 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200 text-xs font-semibold transition">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="mt-2">
    {{ $patients->links() }}
</div>
@endsection
