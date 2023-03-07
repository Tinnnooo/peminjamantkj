<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Pinjambarang;
use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request){

        $rowsBarang = $request->input('rowsBarang') ?? 10;
        $rowsRuangan = $request->input('rowsRuangan') ?? 10;

        $pinjambarang = Pinjambarang::where('status', 'menunggu')->orWhere('status', 'diizinkan dan belum kembali')->paginate($rowsBarang, ['*'], 'barang');
        $pinjamruangan = Pinjamruangan::where('status', 'menunggu')->orWhere('status', 'approve')->paginate($rowsRuangan, ['*'], 'ruangan');

        $countBarang = Pinjambarang::where('status', 'menunggu')->orWhere('status', 'diizinkan dan belum kembali')->get();
        $countRuangan = Pinjamruangan::where('status', 'menunggu')->orWhere('status', 'approve')->get();

        return view('admin.index', [
            'barang' => Barang::all(),
            'ruangan' => Ruangan::all(),
            'user' => User::all(),
            'pinjambarang' => $pinjambarang,
            'pinjamruangan' => $pinjamruangan,
            'countBarang' => count($countBarang),
            'countRuangan' => count($countRuangan),
            'rowsBarang' => $rowsBarang,
            'rowsRuangan' => $rowsRuangan,
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
