<?php

namespace App\Exports;

use App\Models\Bahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportBahan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $bahan = Bahan::all();

        $transformedData = $bahan->map(function($bahan){
            return [
                'id' => $bahan->id,
                'nama_bahan' => $bahan->nama_bahan,
                'stok' => $bahan->stok,
                'deskripsi' => $bahan->deskripsi,
            ];
        });

        return $transformedData;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Bahan',
            'Stok',
            'Deskripsi',
        ];
    }
}
