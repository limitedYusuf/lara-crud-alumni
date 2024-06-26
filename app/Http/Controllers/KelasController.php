<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelass = Kelas::with(['angkatan'])->latest()->get();
        return view('kelas.index', compact('kelass'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $angkatan = Angkatan::latest()->get();

        return view('kelas.create', compact('angkatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:kelas',
            'angkatan_id' => 'required'
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelas $kela)
    {
        $siswas = Siswa::where('kelas_id', $kela->id)->latest()->get();

        $kuliah    = Siswa::where('kelas_id', $kela->id)->where('dikti', '!=', null)->count();
        $gakKuliah = Siswa::where('kelas_id', $kela->id)->whereNull('dikti')->count();

        $rekap = [
            "Lanjut Kuliah"                => $kuliah,
            "Tidak Melanjutkan Pendidikan" => $gakKuliah,
        ];
        
        return view('kelas.show', compact('kela', 'siswas', 'rekap'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kela)
    {
        $angkatan = Angkatan::latest()->get();

        return view('kelas.edit', compact('kela', 'angkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'name' => 'required|unique:kelas,name,' . $kela->id,
            'angkatan_id' => 'required'
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')
            ->with('success', 'Kelas deleted successfully');
    }
}
