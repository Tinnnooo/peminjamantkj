<?php

namespace App\Exports;

use App\Models\Pinjambarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportPinjambarang implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pinjambarangs = Pinjambarang::all();

        // Transform the data to include "nama_barang" instead of "id_barang"
        $transformedData = $pinjambarangs->map(function ($pinjambarang) {
            $barang = $pinjambarang->barang;
            $user = $pinjambarang->user;
            $guru = $pinjambarang->guru;

            return [
                'id' => $pinjambarang->id,
                'nama_peminjam' => $user->nama_lengkap,
                'nama_barang' => $barang->nama_barang,
                'guru_pengajar' => $guru->nama_lengkap,
                'qty' => $pinjambarang->qty,
                'tgl_mulai' => $pinjambarang->tgl_mulai,
                'wkt_mulai' => $pinjambarang->wkt_mulai,
                'tgl_selesai' => $pinjambarang->tgl_selesai,
                'wkt_selesai' => $pinjambarang->wkt_selesai,
                'lokasi_barang' => $pinjambarang->lokasi_barang,
                'status' => $pinjambarang->status,
            ];
        });

        return $transformedData;
    }

     /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Peminjam',
            'Nama Barang',
            'Nama Guru',
            'Jumlah',
            'Tanggal Mulai',
            'Waktu Mulai',
            'Tanggal Selesai',
            'Waktu Selesai',
            'Lokasi Barang',
            'Status',
        ];
    }
}
