<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMaster extends Controller
{
    public function datamaster(Request $request){
    
        $rowsBarang = $request->query('rowsBarang', '10');

        return view('admin.datamaster.index', [
            'barang' => Barang::paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
        ]);
    }

}
