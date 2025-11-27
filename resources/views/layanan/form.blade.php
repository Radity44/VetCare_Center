<form method="POST" action="{{ $action }}">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif
    <label class="block mb-2">Nama Layanan
        <input name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Deskripsi
        <textarea name="deskripsi" rows="2" class="w-full rounded border px-2 py-1">{{ old('deskripsi', $layanan->deskripsi ?? '') }}</textarea>
    </label>
    <label class="block mb-2">Harga
        <input name="harga" type="number" min="0" value="{{ old('harga', $layanan->harga ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Kategori
        <input name="kategori" value="{{ old('kategori', $layanan->kategori ?? '') }}" required class="w-full rounded border px-2 py-1">
    </label>
    <label class="block mb-2">Durasi (menit)
        <input name="durasi" type="number" min="1" value="{{ old('durasi', $layanan->durasi ?? '') }}" class="w-full rounded border px-2 py-1">
    </label>
    <label class="flex items-center gap-2 mb-4">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', ($layanan->is_active ?? 1)) ? 'checked' : '' }}>
        Aktif
    </label>
    <div class="flex justify-between">
        <button class="px-4 py-2 bg-blue-600 text-white rounded" type="submit">
            {{ $layanan ? 'Update' : 'Tambah' }}
        </button>
        <a href="{{ route('layanan.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded">Batal</a>
    </div>
</form>
