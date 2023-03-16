<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamRuanganController extends Controller
{
    // ADMIN

    // RUANGAN DIPINJAM

    public function ruanganDipinjam(Request $request){
        $rowsRuangan = $request->query('rowsRuangan');

        return view('admin.datapeminjaman.index', [
            'ruanganDipinjam' => Pinjamruangan::where('status', !'selesai')->paginate($rowsRuangan),
            'rowsRuangan' => $rowsRuangan,
        ]);
    }

    public function approvePinjamRuangan(Request $request, $id){
        $pinjamRuangan = Pinjamruangan::find($id);

        if($pinjamRuangan){
            $user = Auth::user();

            $pinjamRuangan->status = 'approve by '.$user->nama_lengkap;
            $pinjamRuangan->save();

            Alert::success('Berhasil!', 'Peminjaman telah di approve.');
            return back();
        }
    }

    // RUANGAN KEMBALI
    
    public function ruanganKembali(Request $request){
        $rowsRuangan = $request->query('rowsRuangan');

        return view('admin.datapeminjaman.index', [
            'ruanganKembali' => Pinjamruangan::where('status', 'selesai')->paginate($rowsRuangan),
            'rowsRuangan' => $rowsRuangan,
        ]);
    }
    
}
