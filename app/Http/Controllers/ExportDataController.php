<?php

namespace App\Http\Controllers;

use App\Exports\ExportBahan;
use App\Exports\ExportBarang;
use App\Exports\ExportPinjambarang;
use App\Exports\ExportRuangan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    public function exportPinjambarang(){
        return Excel::download(new ExportPinjambarang, 'pinjambarang.xlsx');
    }

    public function exportBarang(){
        return Excel::download(new ExportBarang, 'barang.xlsx');
    }

    public function exportRuangan(){
        return Excel::download(new ExportRuangan, 'ruangan.xlsx');
    }

    public function exportBahan(){
        return Excel::download(new ExportBahan, 'bahan.xlsx');
    }
}
