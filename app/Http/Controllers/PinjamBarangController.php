<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Pinjambarang;
use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

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
        $role = Role::where('name', 'guru')->first();

        return view('user.index', [
            'pinjambarang' => Pinjambarang::paginate($rowsBarang),
            'rowsBarang' => $rowsBarang,
            'barang' => Barang::where('status', 'free')->where('stok', 1)->get(),
            'guru' => User::role($role)->get(),
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
        $barang = Barang::find($pinjambarang->id_barang);

        if($pinjambarang){
            $barang->stok = 1;
            $barang->save();

            $pinjambarang->tgl_selesai = $request->tgl_selesai;
            $pinjambarang->wkt_selesai = $request->wkt_selesai;
            $pinjambarang->status = 'selesai';
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Berhasil kembalikan pinjaman.');
            return back();
        }
    }

    public function kirimPinjaman(Request $request){
        $validator = Validator::make($request->all(),[
            'nama_barang' => 'required',
            'nama_guru' => 'required',
            'password' => 'required',
            'tgl_mulai' => 'required',
            'wkt_mulai' => 'required',
            'lokasi' => 'required',
        ]);

        if($validator->fails()){
            Alert::error("Validation Error!", $validator->errors()->first());
            return back();
        }

        
        $barang = Barang::where('nama_barang', $request->nama_barang)->first();
        $guru = User::where('nama_lengkap', $request->nama_guru)->first();
        $user = Auth::user();
        if(Hash::check($request->password, $user->password)){
            $barang->stok = 0;
            $barang->save();

        $pinjam = new Pinjambarang();
        $pinjam->id_barang = $barang->id;
        $pinjam->id_guru = $guru->id;
        $pinjam->id_user = $user->id;
        $pinjam->qty = 1;
        $pinjam->tgl_mulai = $request->tgl_mulai;
        $pinjam->wkt_mulai = $request->wkt_mulai;
        $pinjam->tgl_selesai = '00:00:00';
        $pinjam->wkt_selesai = '00:00:00';
        $pinjam->lokasi_barang = $request->lokasi;
        $pinjam->status = 'menunggu';
        $pinjam->save();

        Alert::success('Berhasil!', 'Berhasil Pinjam Barang.');
        return back();
        } else {
            Alert::error('Error!', 'Password salah');
            return back();
        }
    }
}
