<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agama;
use App\Models\Kk;
use App\Models\Penduduk;

class Anggotakk extends Model
{
    use HasFactory;
    protected $fillable = [
        'kk_id',
        'penduduk_id',
        'hubungankk_id',
        'statusaktif',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }

    public function kk()
    {
        return $this->belongsTo(Kk::class);
    }

    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class);
    }
}
