<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBarang implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $barang = Barang::all();

        $transformedData = $barang->map(function ($barang) {

            return [
                'id' => $barang->id,
                'nama_barang' => $barang->nama_barang,
                'stok' => $barang->stok,
                'deskripsi' => $barang->deskripsi,
                'status' => $barang->status,
            ];
        });

        return $transformedData;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Stok',
            'Deskripsi',
            'Status',
        ];
    }
}
