<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjambarang extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty',
        'tgl_mulai',
        'wkt_mulai',
        'tgl_selesai',
        'wkt_selesai',
        'lokasi_barang',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function barang(){
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}
