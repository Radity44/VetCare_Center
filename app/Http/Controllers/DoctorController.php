<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::orderByDesc('created_at')->paginate(10);
        return view('dokter.index', compact('doctors'));
    }

    public function create()
    {
        return view('dokter.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'spesialis'=> 'required|string|max:50',
            'telepon'  => 'required|string|max:20',
            'email'    => 'required|email|max:100|unique:doctors,email',
            'alamat'   => 'required|string|max:200',
            'is_active'=> 'boolean',
        ]);
        Doctor::create($validated + ['is_active' => $request->has('is_active')]);
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil ditambahkan!');
    }

    public function show(Doctor $dokter)
    {
        return view('dokter.show', compact('dokter'));
    }

    public function edit(Doctor $dokter)
    {
        return view('dokter.edit', compact('dokter'));
    }

    public function update(Request $request, Doctor $dokter)
    {
        $validated = $request->validate([
            'nama'     => 'required|string|max:100',
            'spesialis'=> 'required|string|max:50',
            'telepon'  => 'required|string|max:20',
            'email'    => 'required|email|max:100|unique:doctors,email,' . $dokter->id,
            'alamat'   => 'required|string|max:200',
            'is_active'=> 'boolean',
        ]);
        $dokter->update($validated + ['is_active' => $request->has('is_active')]);
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diupdate!');
    }

    public function destroy(Doctor $dokter)
    {
        $dokter->delete();
        return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil dihapus!');
    }
}
