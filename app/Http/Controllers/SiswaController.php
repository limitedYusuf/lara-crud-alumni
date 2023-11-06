<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::with(['angkatan', 'kelas'])->latest()->get();

        return view('siswa.index', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $angkatan = Angkatan::latest()->get();
        $kelas = Kelas::latest()->get();

        return view('siswa.create', compact('angkatan', 'kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'angkatan_id' => 'required',
            'kelas_id' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelahiran' => 'required',
            'link' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/siswa_foto', $fileName);
            $input['foto'] = $fileName;
        }

        Siswa::create($input);

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $angkatan = Angkatan::latest()->get();
        $kelas = Kelas::latest()->get();

        return view('siswa.edit', compact('siswa','angkatan', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name' => 'required',
            'angkatan_id' => 'required',
            'kelas_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelahiran' => 'required',
            'link' => 'required',
        ]);

        $input = $request->all();

        if ($request->hasFile('foto')) {
            $image = $request->file('foto');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/siswa_foto', $fileName);
            $input['foto'] = $fileName;
        } else {
            unset($input['foto']);
        }

        $siswa->update($input);

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')
            ->with('success', 'Siswa deleted successfully');
    }
}
