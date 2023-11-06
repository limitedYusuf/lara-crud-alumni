<?php

namespace App\Models;

use App\Models\Angkatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }
}
