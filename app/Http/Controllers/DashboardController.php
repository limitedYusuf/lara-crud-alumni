<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Angkatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        return view('dashboard', compact('siswa', 'countSiswa', 'data', 'angkatans'));
    }
}
