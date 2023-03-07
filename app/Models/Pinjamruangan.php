<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjamruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'tgl_mulai',
        'wkt_mulai',
        'tgl_selesai',
        'wkt_selesai',
        'status',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }   

    public function ruangan(){
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }
}
