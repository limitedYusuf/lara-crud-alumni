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
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validate the input.
         */
        $request->validate([
            'name'        => 'required',
            'angkatan_id' => 'required',
            'kelas_id'    => 'required',
            'foto'        => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelahiran'   => 'required',
            'link'        => 'required',
            'dikti'       => 'required',
        ]);

        /**
         * Retrieve the input from the request.
         */
        $input = $request->all();

        /**
         * If the request has a file, store it and update the filename in the input.
         */
        if ($request->hasFile('foto')) {
            $image    = $request->file('foto');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/siswa_foto', $fileName);
            $input['foto'] = $fileName;
        }

        /**
         * Create the siswa with the input.
         */
        Siswa::create($input);

        /**
         * Return a redirect response to the index route with a success message.
         */
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

    public function search(Request $request)
    {
        $data = Siswa::where('id', $request->id)->firstOrFail();

        return view('siswa.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Siswa $siswa Siswa model
     *
     * @return \Illuminate\View\View
     */
    public function edit(Siswa $siswa)
    {
        $angkatan = Angkatan::latest()->get();
        $kelas = Kelas::latest()->get();

        return view('siswa.edit', compact('siswa', 'angkatan', 'kelas'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Siswa $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        /**
         * Validate the input.
         */
        $request->validate([
            'name'        => 'required',
            'angkatan_id' => 'required',
            'kelas_id'    => 'required',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kelahiran'   => 'required',
            'link'        => 'required',
            'dikti'       => 'nullable',
        ]);

        /**
         * Retrieve the input from the request.
         */
        $input = $request->all();

        /**
         * If the request has a file, store it and update the filename in the input.
         */
        if ($request->hasFile('foto')) {
            $image    = $request->file('foto');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/siswa_foto', $fileName);
            $input['foto'] = $fileName;
        } else {
            /**
             * If there is no file, unset the foto from the input,
             * so the previous one will remain.
             */
            unset($input['foto']);
        }

        /**
         * Update the siswa with the new input.
         */
        $siswa->update($input);

        /**
         * Return a redirect response to the index route with a success message.
         */
        return redirect()->route('siswa.index')
            ->with('success', 'Siswa updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        // Delete the siswa from the storage
        $siswa->delete();

        // Redirect to the index page with a success message
        return redirect()->route('siswa.index')
            ->with('success', 'Siswa deleted successfully');
    }

}
