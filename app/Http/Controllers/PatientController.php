<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderByDesc('created_at')->paginate(10);
        return view('pasien.index', compact('patients'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hewan'      => 'required|string|max:100',
            'jenis_hewan'     => 'required|string|max:30',
            'ras'             => 'nullable|string|max:50',
            'umur_hewan'      => 'required|integer|min:0',
            'jenis_kelamin'   => 'required|in:Jantan,Betina',
            'riwayat_perawatan'=> 'nullable|string',
            'status'          => 'required|in:Booking,Pemeriksaan,Pra-Karantina,Operasi,Pasca-Karantina,Rawat Jalan,Selesai',
        ]);
        Patient::create($validated);
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan!');
    }

    public function show(Patient $pasien)
    {
        return view('pasien.show', compact('pasien'));
    }

    public function edit(Patient $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Patient $pasien)
    {
        $validated = $request->validate([
            'nama_hewan'      => 'required|string|max:100',
            'jenis_hewan'     => 'required|string|max:30',
            'ras'             => 'nullable|string|max:50',
            'umur_hewan'      => 'required|integer|min:0',
            'jenis_kelamin'   => 'required|in:Jantan,Betina',
            'riwayat_perawatan'=> 'nullable|string',
            'status'          => 'required|in:Booking,Pemeriksaan,Pra-Karantina,Operasi,Pasca-Karantina,Rawat Jalan,Selesai',
        ]);
        $pasien->update($validated);
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diupdate!');
    }

    // Khusus form update status fase
    public function editStatus(Patient $pasien)
    {
        return view('pasien.update_status', compact('pasien'));
    }

    public function updateStatus(Request $request, Patient $pasien)
    {
        $request->validate([
            'status' => 'required|in:Booking,Pemeriksaan,Pra-Karantina,Operasi,Pasca-Karantina,Rawat Jalan,Selesai',
        ]);
        $pasien->update(['status' => $request->status]);
        return redirect()->route('pasien.show', $pasien)->with('success', 'Status pasien berhasil diupdate!');
    }

    public function destroy(Patient $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus!');
    }
}
