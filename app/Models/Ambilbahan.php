<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ambilbahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_bahan',
        'id_user',
        'tgl_ambil',
        'wkt_ambil',
        'qty',
        'deskripsi',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }   

    public function bahan(){
        return $this->belongsTo(Bahan::class, 'id_bahan');
    }
}
