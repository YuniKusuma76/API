<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penduduk;
use App\Models\Anggotakk;

class Agama extends Model
{
    use HasFactory;
    protected $fillable = [
        'agama',
        'created_at',
        'updated_at',
    ];

    public function penduduk()
    {
        return $this->hasMany(Penduduk::class);
    }

    public function anggotakk()
    {
        return $this->hasMany(Anggotakk::class);
    }
}
