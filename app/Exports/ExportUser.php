<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $user = User::all();

        $transformedData = $user->map(function($user){
            return [
                'id' => $user->id,
                'nama_lengkap' => $user->nama_lengkap,
                'username' => $user->username,
                'email' => $user->email,
                'nohp' => $user->nohp,
                'rfid' => $user->rfid,
                'status' => $user->status,
            ];
        });

        return $transformedData;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nama Lengkap',
            'Username',
            'Email',
            'No HP',
            'RFID',
            'Status',
        ];
    }
}
