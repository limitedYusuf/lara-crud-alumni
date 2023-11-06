<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Angkatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'name',
        'angkatan_id',
        'kelas_id',
        'foto',
        'kelahiran',
        'link',
    ];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
