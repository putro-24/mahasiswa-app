<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurusan;

class JurusanController extends Controller
{
    public function index()
    {
        $data = Jurusan::all();
        return view('jurusan.index', compact('data'));
    }

    public function create()
    {
        return view('jurusan.create');
    }

    public function store(Request $request)
    {
        Jurusan::create($request->all());
        return redirect()->route('jurusan.index');
    }

    public function edit($id)
    {
        $item = Jurusan::findOrFail($id);
        return view('jurusan.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Jurusan::findOrFail($id);
        $item->update($request->all());
        return redirect()->route('jurusan.index');
    }

    public function destroy($id)
    {
        $item = Jurusan::findOrFail($id);
        $item->delete();
        return redirect()->route('jurusan.index');
    }
}
