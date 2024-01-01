<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggotakk;

class Kk extends Model
{
    use HasFactory;
    protected $fillable = [
        'nokk',
        'statusaktif',
        'created_at',
        'updated_at',
    ];

    public function anggotakk()
    {
        return $this->hasMany(Anggotakk::class);
    }
}
