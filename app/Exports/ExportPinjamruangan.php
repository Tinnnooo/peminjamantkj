<?php

namespace App\Exports;

use App\Models\Pinjamruangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPinjamruangan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pinjamruangan = Pinjamruangan::all();

        $transformedData = $pinjamruangan->map(function($pinjamruangan){

            $ruangan = $pinjamruangan->ruangan;
            $user = $pinjamruangan->user;
            $guru = $pinjamruangan->guru;

            return [
                'id' => $pinjamruangan->id,
                'nama_ruangan' => $ruangan->nama_ruangan,
                'user' => $user->nama_lengkap,
                'guru' => $guru->nama_lengkap,
                'tgl_mulai' => $pinjamruangan->tgl_mulai,
                'wkt_mulai' => $pinjamruangan->wkt_mulai,
                'tgl_selesai' => $pinjamruangan->tgl_selesai,
                'wkt_selesai' => $pinjamruangan->wkt_selesai,
                'status' => $pinjamruangan->status,
            ];

        });
        
        return $transformedData;

    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Ruangan',
            'Nama Peminjam',
            'Guru Pengajar',
            'Tanggal Mulai',
            'Waktu Mulai',
            'Tanggal Selesai',
            'Waktu Selesai',
            'Status',
        ];
    }
}
