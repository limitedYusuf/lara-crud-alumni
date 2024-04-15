<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswa = Siswa::latest()->get();
        $countSiswa = Siswa::count();

        $angkatans = Angkatan::all();
        $data = [];

        foreach ($angkatans as $angkatan) {
            $count = Siswa::where('angkatan_id', $angkatan->id)->count();
            $data[] = [
                'name' => $angkatan->name,
                'count' => $count,
            ];
        }

        $kuliah    = Siswa::where('dikti', '!=', null)->count();
        $gakKuliah = Siswa::whereNull('dikti')->count();

        $rekap = [
            "Lanjut Kuliah"                => $kuliah,
            "Tidak Melanjutkan Pendidikan" => $gakKuliah,
        ];
        
        return view('home', compact('siswa', 'countSiswa', 'data', 'rekap', 'angkatans'));
    }

    public function pengajuan()
    {
        $contacts = Contact::with(['alumni'])->latest()->get();

        return view('pengajuan', compact('contacts'));
    }
}
