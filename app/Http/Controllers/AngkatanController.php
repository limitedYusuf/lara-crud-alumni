<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angkatan;

class AngkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angkatans = Angkatan::latest()->get();
        return view('angkatan.index', compact('angkatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('angkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:angkatans',
        ]);

        Angkatan::create($request->all());

        return redirect()->route('angkatan.index')
            ->with('success', 'Angkatan created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Angkatan $angkatan)
    {
        return view('angkatan.show', compact('angkatan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Angkatan $angkatan)
    {
        return view('angkatan.edit', compact('angkatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Angkatan $angkatan)
    {
        $request->validate([
            'name' => 'required|unique:angkatans,name,' . $angkatan->id,
        ]);

        $angkatan->update($request->all());

        return redirect()->route('angkatan.index')
            ->with('success', 'Angkatan updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Angkatan $angkatan)
    {
        $angkatan->delete();

        return redirect()->route('angkatan.index')
            ->with('success', 'Angkatan deleted successfully');
    }
}
