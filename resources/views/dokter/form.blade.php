<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <label class="block mb-2">Nama
        <input name="nama" value="{{ old('nama', $dokter->nama ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Spesialis
        <input name="spesialis" value="{{ old('spesialis', $dokter->spesialis ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Telepon
        <input name="telepon" value="{{ old('telepon', $dokter->telepon ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Email
        <input name="email" type="email" value="{{ old('email', $dokter->email ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Alamat
        <textarea name="alamat" rows="2" class="w-full rounded border px-2 py-1" required>{{ old('alamat', $dokter->alamat ?? '') }}</textarea>
    </label>
    <label class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', ($dokter->is_active ?? 1)) ? 'checked' : '' }}>
        Aktif
    </label>
    <div class="flex justify-between">
        <button class="px-4 py-2 bg-blue-600 text-white rounded" type="submit">
            {{ $dokter ? 'Update' : 'Tambah' }}
        </button>
        <a href="{{ route('dokter.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Batal</a>
    </div>
</form>
