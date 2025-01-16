<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_ruangan',
        'deskripsi',
        'foto',
    ];

    public function pinjamruangans()
    {
        return $this->hasMany(Pinjamruangan::class, 'id_ruangan');
    }
}
