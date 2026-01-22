<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use App\Models\Registrant;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $ekskuls = Ekskul::all();
        return view('welcome', compact('ekskuls'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_siswa' => 'required',
            'kelas' => 'required',
            'no_wa' => 'required',
            'ekskul_id' => 'required|exists:ekskuls,id',
        ]);

        Registrant::create($request->all());

        return back()->with('success', 'Selamat! Kamu berhasil mendaftar ekskul.');
    }
}
