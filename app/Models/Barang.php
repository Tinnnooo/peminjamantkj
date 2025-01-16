<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'stok',
        'deskripsi',
        'foto',
        'status',
    ];

    public function pinjambarangs()
    {
        return $this->hasMany(Pinjambarang::class, 'id_barang');
    }
}
