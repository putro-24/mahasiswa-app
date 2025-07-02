<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramStudi;

class ProdiController extends Controller
{
    public function index()
    {
        $data = ProgramStudi::all();
        return view('prodi.index', compact('data'));
    }

    public function create()
    {
        return view('prodi.create');
    }

    public function store(Request $request)
    {
        ProgramStudi::create($request->all());
        return redirect()->route('prodi.index');
    }

    public function edit($id)
    {
        $item = ProgramStudi::findOrFail($id);
        return view('prodi.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = ProgramStudi::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('prodi.index');
    }

    public function destroy($id)
    {
        $item = ProgramStudi::findOrFail($id);
        $item->delete();
        return redirect()->route('prodi.index');
    }
}
