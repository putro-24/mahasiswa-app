<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;
use App\Models\ProgramStudi;

class JurusanController extends Controller
{
    public function index()
    {
        // Ambil semua jurusan dengan relasi prodi
        $jurusans = Jurusan::with('programStudi')->get();
        return view('jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans',
            'id_kajur' => 'nullable|exists:users,id'
        ]);

        Jurusan::create($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function show($id)
    {
        $jurusan = Jurusan::with('programStudi')->findOrFail($id);
        return view('jurusan.show', compact('jurusan'));
    }

    public function edit($id)
    {
        $item = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:255',
            'kode_jurusan' => 'required|string|max:10|unique:jurusans,kode_jurusan,' . $id,
            'id_kajur' => 'nullable|exists:users,id'
        ]);

        $item = Jurusan::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy($id)
    {
        $item = Jurusan::findOrFail($id);
        $item->delete();
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }

    // Method untuk menampilkan prodi berdasarkan jurusan
    public function getProdi($jurusanId)
    {
        $jurusan = Jurusan::with('programStudi')->findOrFail($jurusanId);
        return response()->json($jurusan->programStudi);
    }
}