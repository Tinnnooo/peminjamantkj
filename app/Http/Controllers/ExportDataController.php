<?php

namespace App\Http\Controllers;

use App\Exports\ExportAmbilBahan;
use App\Exports\ExportBahan;
use App\Exports\ExportBarang;
use App\Exports\ExportPinjambarang;
use App\Exports\ExportPinjamruangan;
use App\Exports\ExportRuangan;
use App\Exports\ExportUser;
use Maatwebsite\Excel\Facades\Excel;

class ExportDataController extends Controller
{
    public function exportPinjambarang()
    {
        return Excel::download(new ExportPinjambarang, 'pinjambarang.xlsx');
    }

    public function exportPinjamruangan()
    {
        return Excel::download(new ExportPinjamruangan, 'pinjamruangan.xlsx');
    }

    public function exportAmbilBahan()
    {
        return Excel::download(new ExportAmbilBahan, 'ambilbahan.xlsx');
    }

    public function exportBarang()
    {
        return Excel::download(new ExportBarang, 'barang.xlsx');
    }

    public function exportRuangan()
    {
        return Excel::download(new ExportRuangan, 'ruangan.xlsx');
    }

    public function exportBahan()
    {
        return Excel::download(new ExportBahan, 'bahan.xlsx');
    }

    public function exportUsers()
    {
        return Excel::download(new ExportUser, 'user.xlsx');
    }
}
