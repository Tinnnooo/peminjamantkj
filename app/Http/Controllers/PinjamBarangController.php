<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Pinjambarang;
use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PinjamBarangController extends Controller
{
    //ADMIN

    // BARANG DIPINJAM

    public function barangDipinjam(Request $request){

        $rowsBarang = $request->query('rowsBarang');

        return view('admin.datapeminjaman.index', [
            'pinjambarang' => Pinjambarang::where('status', !'selesai')->paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
        ]);
    }

    public function approvePinjamBarang($id){
        $pinjambarang = Pinjambarang::find($id);

        if($pinjambarang){
            $user = Auth::user();

            $pinjambarang->status = 'approve by '.$user->nama_lengkap;
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Peminjaman telah di approve.');
            return back();
        }
    }

    // BARANG KEMBALI

    public function barangKembali(Request $request){

        $rowsBarang = $request->query('rowsBarang');
        
        return view('admin.datapeminjaman.index',[
            'barangKembali' => Pinjambarang::where('status', !'dibatalkan')->orWhere('status', 'LIKE' ,'%selesai%')->paginate($rowsBarang),
            'rowsBarang' => $rowsBarang
        ]);
    }

    // BARANG BATAL

    public function barangBatal(Request $request){
        $rowsBarang = $request->query('rowsBarang');

        return view('admin/datapeminjaman.index', [
            'barangBatal' => Pinjambarang::where('status', 'LIKE', '%batal%')->paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
        ]);
    }

    // PINJAM BARANG

    public function pinjamBarang(Request $request){
        $rowsBarang = $request->query('rowsBarang', 10);

        return view('user.index', [
            'pinjambarang' => Pinjambarang::paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
        ]);
    }

    // BATAL PINJAM
    public function batalPinjam(Request $request, $id){
        $pinjambarang = Pinjambarang::find($id);

        if($pinjambarang){
            $pinjambarang->tgl_selesai = $request->tgl_selesai;
            $pinjambarang->wkt_selesai = $request->wkt_selesai;
            $pinjambarang->status = 'batal pinjam';
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Pinjaman telah di batalkan');
            return back();
        }
    }

    // KEMBALIKAN PINJAMAN
    public function kembaliPinjam(Request $request, $id){
        $pinjambarang = Pinjambarang::find($id);

        if($pinjambarang){
            $pinjambarang->tgl_selesai = $request->tgl_selesai;
            $pinjambarang->wkt_selesai = $request->wkt_selesai;
            $pinjambarang->status = 'selesai';
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Berhasil kembalikan pinjaman.');
            return back();
        }
    }
}
