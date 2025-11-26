@extends('layouts.admin')
@section('header', 'Edit Data Pasien')
@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow space-y-2">
    <h2 class="font-bold text-lg mb-2 text-blue-700">Edit Pasien: <span class="text-gray-800">{{ $pasien->nama_hewan }}</span></h2>

    <form method="POST" action="{{ route('pasien.update', $pasien) }}">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-2 gap-2 mb-2">
            <div>
                <label class="block text-sm">Nama Hewan</label>
                <input name="nama_hewan" value="{{ old('nama_hewan', $pasien->nama_hewan) }}" required class="w-full rounded border-gray-300 py-1 px-2">
            </div>
            <div>
                <label class="block text-sm">Jenis Hewan</label>
                <input name="jenis_hewan" value="{{ old('jenis_hewan', $pasien->jenis_hewan) }}" required class="w-full rounded border-gray-300 py-1 px-2">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2 mb-2">
            <div>
                <label class="block text-sm">Ras</label>
                <input name="ras" value="{{ old('ras', $pasien->ras) }}" class="w-full rounded border-gray-300 py-1 px-2">
            </div>
            <div>
                <label class="block text-sm">Umur (tahun)</label>
                <input type="number" name="umur_hewan" min="0" value="{{ old('umur_hewan', $pasien->umur_hewan) }}" required class="w-full rounded border-gray-300 py-1 px-2">
            </div>
        </div>
        <div class="grid grid-cols-2 gap-2 mb-2">
            <div>
                <label class="block text-sm">Jenis Kelamin</label>
                <select name="jenis_kelamin" required class="w-full rounded border-gray-300 py-1 px-2">
                    <option value="Jantan" {{ $pasien->jenis_kelamin=='Jantan'?'selected':'' }}>Jantan</option>
                    <option value="Betina" {{ $pasien->jenis_kelamin=='Betina'?'selected':'' }}>Betina</option>
                </select>
            </div>
            <div>
                <label class="block text-sm">Status</label>
                <select name="status" class="w-full rounded border-gray-300 py-1 px-2">
                    @foreach(['Booking','Pemeriksaan','Pra-Karantina','Operasi','Pasca-Karantina','Rawat Jalan','Selesai'] as $s)
                        <option value="{{ $s }}" {{ $pasien->status==$s?'selected':'' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div>
            <label class="block text-sm">Riwayat Perawatan</label>
            <textarea name="riwayat_perawatan" rows="2" class="w-full rounded border-gray-300 py-1 px-2">{{ old('riwayat_perawatan', $pasien->riwayat_perawatan) }}</textarea>
        </div>
        <div class="flex justify-between mt-4">
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 font-semibold">Update</button>
            <a href="{{ route('pasien.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
        </div>
    </form>
</div>
@endsection
