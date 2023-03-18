<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Pinjambarang;
use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;

class GuruController extends Controller
{
    // INDEX
    public function index(Request $request){

        $rowsBarang = $request->query('rowsBarang', 10);
        $rowsRuangan = $request->query('rowsRuangan', 10);

        $guru = Auth::user();

        $pinjambarang = Pinjambarang::where('id_guru', $guru->id)->where(function ($query) {
            $query->where('status', 'menunggu')
                ->orWhere('status', 'LIKE', '%approve%');
        })->orderBy('status')->paginate($rowsBarang, ['*'], 'barang');
        $pinjamruangan = Pinjamruangan::where('id_guru', $guru->id)->where(function ($query) {
            $query->where('status', 'menunggu')
                ->orWhere('status', 'LIKE', '%approve%');
        })->orderBy('status')->paginate($rowsRuangan, ['*'], 'ruangan');

        $countBarang = Pinjambarang::where('status', 'menunggu')->orWhere('status','like', '%diizinkan%')->orWhere('status', 'like', '%approve%')->get();
        $countRuangan = Pinjamruangan::where('status', 'menunggu')->orWhere('status', 'like', '%approve%')->get();

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

    public function approveBarang($id){
        $user = Auth::user();
        $pinjambarang = Pinjambarang::find($id);

        if($user && $pinjambarang){
            $pinjambarang->status = 'approve by '.$user->nama_lengkap;
            $pinjambarang->save();
            return back();
        }
    }

    public function approveRuangan($id){
        $user = Auth::user();
        $pinjamruangan = Pinjamruangan::find($id);

        if($user && $pinjamruangan){
            $pinjamruangan->status = 'approve by '.$user->nama_lengkap;
            $pinjamruangan->save();
            return back();
        }
    }
}
