@extends('layouts.admin')
@section('header', 'Update Status Pasien')
@section('content')
<form method="POST" action="{{ route('pasien.updateStatus', $pasien) }}" class="max-w-md mx-auto bg-white p-6 rounded shadow">
    @csrf
    <label>Status Fase Perawatan:
        <select name="status" class="block w-full mb-4">
            @foreach(['Booking', 'Pemeriksaan', 'Pra-Karantina', 'Operasi', 'Pasca-Karantina', 'Rawat Jalan', 'Selesai'] as $s)
            <option value="{{ $s }}" {{ $pasien->status==$s?'selected':'' }}>{{ $s }}</option>
            @endforeach
        </select>
    </label>
    <button class="px-4 py-2 bg-yellow-600 text-white rounded" type="submit">Update Status</button>
    <a href="{{ route('pasien.show', $pasien) }}" class="ml-2 px-4 py-2 bg-gray-400 text-white rounded">Batal</a>
</form>
@endsection
