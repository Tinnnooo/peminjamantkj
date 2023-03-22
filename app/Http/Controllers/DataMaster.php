<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataMaster extends Controller
{
    public function barang(Request $request){

        $rowsBarang = $request->query('rowsBarang', '10');
        $search = '%'.$request->input('search', '').'%';

        if($request->has('sort')){
            $sort = $request->query('sort');
            $barang = Barang::where('nama_barang', 'like', $search)->orderBy($sort)->paginate($rowsBarang);
        } else {
            $barang = Barang::where('nama_barang', 'like', $search)->paginate($rowsBarang);
        }

        return view('admin.datamaster.index', [
            'barang' => $barang,
            'rowsBarang' => $rowsBarang,
            'search' => $request->input('search'),
        ]);
    }

    public function ruangan(Request $request){
        $rowsRuangan = $request->query('rowsRuangan', 10);
        $search = '%'.$request->input('search', '').'%';

        if($request->has('sort')){
            $sort = $request->query('sort');
            $ruangan = Ruangan::where('nama_ruangan', 'like', $search)->orderBy($sort)->paginate($rowsRuangan);
        } else {
            $ruangan = Ruangan::where('nama_ruangan', 'like', $search)->paginate($rowsRuangan);
        }

        return view('admin.datamaster.index', [
            'ruangan' => $ruangan,
            'rowsRuangan' => $rowsRuangan,
            'search' => $request->input('search'),
        ]);
    }

    public function bahan(Request $request){
        $rowsBahan = $request->query('rowsBahan', 10);
        $search = '%'.$request->input('search', '').'%';

        if($request->has('sort')){
            $sort = $request->query('sort');
            $bahan = Bahan::where('nama_bahan', 'like', $search)->orderBy($sort)->paginate($rowsBahan);
        } else {
            $bahan = Bahan::where('nama_bahan', 'like', $search)->paginate($rowsBahan);
        }

        return view('admin.datamaster.index',[
            'bahans' => $bahan,
            'rowsBahan' => $rowsBahan,
            'search' => $request->input('search'),
        ]);
    }
}
