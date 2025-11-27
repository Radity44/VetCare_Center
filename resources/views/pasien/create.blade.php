@extends('layouts.admin')
@section('header', 'Tambah Pasien')
@section('content')
<form method="POST" action="{{ route('pasien.store') }}" class="max-w-lg mx-auto bg-white p-6 rounded shadow">
    @csrf
    <label>Nama Hewan<input name="nama_hewan" value="{{ old('nama_hewan') }}" required class="block w-full mb-2"></label>
    <label>Jenis Hewan<input name="jenis_hewan" value="{{ old('jenis_hewan') }}" required class="block w-full mb-2"></label>
    <label>Ras<input name="ras" value="{{ old('ras') }}" class="block w-full mb-2"></label>
    <label>Umur<input type="number" name="umur_hewan" value="{{ old('umur_hewan') }}" required class="block w-full mb-2"></label>
    <label>Jenis Kelamin
        <select name="jenis_kelamin" required class="block w-full mb-2">
            <option value="Jantan">Jantan</option>
            <option value="Betina">Betina</option>
        </select>
    </label>
    <label>Riwayat Perawatan<textarea name="riwayat_perawatan" class="block w-full mb-2">{{ old('riwayat_perawatan') }}</textarea></label>
    <label>Status
        <select name="status" class="block w-full mb-2">
            @foreach(['Booking', 'Pemeriksaan', 'Pra-Karantina', 'Operasi', 'Pasca-Karantina', 'Rawat Jalan', 'Selesai'] as $s)
            <option value="{{ $s }}">{{ $s }}</option>
            @endforeach
        </select>
    </label>
    <button class="px-4 py-2 bg-blue-600 text-white rounded" type="submit">Simpan</button>
</form>
@endsection
