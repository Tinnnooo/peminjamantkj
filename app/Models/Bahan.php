<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_bahan",
        'stok',
        'deskripsi',
        'foto'
    ];

    public function ambilbahan(){
        return $this->hasMany(Ambilbahan::class, 'id_bahan');
    }
}
