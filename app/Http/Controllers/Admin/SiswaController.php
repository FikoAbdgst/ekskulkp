<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registrant;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $registrants = Registrant::with('ekskul')->latest()->get();
        return view('admin.siswa.index', compact('registrants'));
    }

    public function destroy($id)
    {
        Registrant::findOrFail($id)->delete();
        return back()->with('success', 'Data siswa berhasil dihapus');
    }
}
