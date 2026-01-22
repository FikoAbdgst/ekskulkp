<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ekskul;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskuls = Ekskul::all();
        return view('admin.ekskul.index', compact('ekskuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'jadwal' => 'required',
        ]);

        Ekskul::create($request->all());
        return back()->with('success', 'Ekskul berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $ekskul = Ekskul::findOrFail($id);
        return view('admin.ekskul.edit', compact('ekskul'));
    }

    public function update(Request $request, $id)
    {
        $ekskul = Ekskul::findOrFail($id);
        $ekskul->update($request->all());
        return redirect()->route('admin.ekskul.index')->with('success', 'Ekskul berhasil diupdate!');
    }

    public function destroy($id)
    {
        Ekskul::findOrFail($id)->delete();
        return back()->with('success', 'Ekskul berhasil dihapus!');
    }
}
