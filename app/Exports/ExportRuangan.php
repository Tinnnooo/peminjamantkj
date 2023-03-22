<?php

namespace App\Exports;

use App\Models\Ruangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRuangan implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $ruangan = Ruangan::all();

        $transformedData = $ruangan->map(function($ruangan){
            return [
                'id' => $ruangan->id,
                'nama_ruangan' => $ruangan->nama_ruangan,
                'deskripsi' => $ruangan->deskripsi,
                'status' => $ruangan->status,
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
            'Nama Ruangan',
            'Deskripsi',
            'Status',
        ];
    }
}
