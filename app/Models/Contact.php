<?php

namespace App\Models;

use App\Models\Alumni;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
