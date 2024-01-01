<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggotakk;

class Hubungankk extends Model
{
    use HasFactory;
    protected $fillable = [
        'hubungankk',
        'created_at',
        'updated_at',
    ];

    public function anggotakk()
    {
        return $this->hasMany(Anggotakk::class);
    }
}
