<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa      = Siswa::latest()->get();
        $countSiswa = Siswa::count();

        $angkatans = Angkatan::all();
        $data      = [];

        foreach ($angkatans as $angkatan) {
            $count  = Siswa::where('angkatan_id', $angkatan->id)->count();
            $data[] = [
                'name'  => $angkatan->name,
                'count' => $count,
            ];
        }

        $kuliah    = Siswa::where('dikti', '!=', null)->count();
        $gakKuliah = Siswa::whereNull('dikti')->count();

        $rekap = [
            "Lanjut Kuliah"                => $kuliah,
            "Tidak Melanjutkan Pendidikan" => $gakKuliah,
        ];

        return view('dashboard', compact('siswa', 'countSiswa', 'data', 'angkatans', 'rekap'));
    }

    public function postComment(Request $request)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        $post = new Contact();
        $post->comment = $request->comment;
        $post->alumni_id = auth()->user()->id;
        $post->save();

        return redirect()->back()->with('success', 'Komentar telah dikirim..');
    }
}
