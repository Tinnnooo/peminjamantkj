<?php

namespace App\Exports;

use App\Models\AmbilBahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportAmbilBahan implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $ambilBahan = AmbilBahan::all();

        $transformedData = $ambilBahan->map(function ($ambilBahan) {

            $bahan = $ambilBahan->bahan;
            $user = $ambilBahan->user;

            return [
                'id' => $ambilBahan->id,
                'nama_bahan' => $bahan->nama_bahan,
                'nama_pengambil' => $user->nama_lengkap,
                'tgl_ambil' => $ambilBahan->tgl_ambil,
                'wkt_ambil' => $ambilBahan->wkt_ambil,
                'jumlah_ambil' => $ambilBahan->qty,
                'peruntukan' => $ambilBahan->deskripsi,
                'status' => $ambilBahan->status,
            ];
        });

        return $transformedData;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Bahan',
            'Nama Pengambil',
            'Tanggal Ambil',
            'Waktu Ambil',
            'Jumlah Ambil',
            'Peruntukan',
            'Status',
        ];
    }
}
