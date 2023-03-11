<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMaster extends Controller
{
    public function barang(Request $request){

        $rowsBarang = $request->query('rowsBarang', '10');

        return view('admin.datamaster.index', [
            'barang' => Barang::paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
        ]);
    }

    public function ruangan(Request $request){
        $rowsRuangan = $request->query('rowsRuangan', 10);
        return view('admin.datamaster.index', [
            'ruangan' => Ruangan::paginate($rowsRuangan),
            'rowsRuangan' => $rowsRuangan,
        ]);
    }

}
