<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggotakk;
use App\Models\Agama;

class Penduduk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'lahir',
        'agama_id',
        'created_at',
        'updated_at',
    ];

    public function anggotakk()
    {
        return $this->hasMany(Anggotakk::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
}
