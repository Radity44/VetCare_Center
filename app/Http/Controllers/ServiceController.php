<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderByDesc('created_at')->paginate(10);
        return view('layanan.index', compact('services'));
    }

    public function create()
    {
        return view('layanan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:200',
            'harga'        => 'required|numeric|min:0',
            'kategori'     => 'required|string|max:50',
            'durasi'       => 'nullable|integer|min:1',
            'is_active'    => 'boolean',
        ]);
        Service::create($validated + ['is_active' => $request->has('is_active')]);
        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil ditambahkan!');
    }

    public function show(Service $layanan)
    {
        return view('layanan.show', compact('layanan'));
    }

    public function edit(Service $layanan)
    {
        return view('layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Service $layanan)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi'    => 'nullable|string|max:200',
            'harga'        => 'required|numeric|min:0',
            'kategori'     => 'required|string|max:50',
            'durasi'       => 'nullable|integer|min:1',
            'is_active'    => 'boolean',
        ]);
        $layanan->update($validated + ['is_active' => $request->has('is_active')]);
        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil diupdate!');
    }

    public function destroy(Service $layanan)
    {
        $layanan->delete();
        return redirect()->route('layanan.index')->with('success', 'Data layanan berhasil dihapus!');
    }
}
