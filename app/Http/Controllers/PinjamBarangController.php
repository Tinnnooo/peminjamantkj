<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pinjambarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class PinjamBarangController extends Controller
{
    // ADMIN

    // BARANG DIPINJAM

    public function barangDipinjam(Request $request)
    {

        $rowsBarang = $request->query('rowsBarang');
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Barang::where('nama_barang', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $pinjambarang = Pinjambarang::where('status', '<>', 'selesai')->where('status', '<>', 'batal pinjam')->whereIn('id_barang', $searchName)->paginate($rowsBarang);
            } else {
                $pinjambarang = Pinjambarang::where('status', '<>', 'selesai')->where('status', '<>', 'batal pinjam')->where('id_barang', '0')->paginate($rowsBarang);
            }
        } elseif ($search == null) {
            $pinjambarang = Pinjambarang::where('status', '<>', 'selesai')->where('status', '<>', 'batal pinjam')->paginate($rowsBarang);
        }

        return view('admin.datapeminjaman.index', [
            'pinjambarang' => $pinjambarang,
            'rowsBarang' => $rowsBarang,
            'search' => $search,
        ]);
    }

    public function approvePinjamBarang($id)
    {
        $pinjambarang = Pinjambarang::find($id);

        if ($pinjambarang) {
            $user = Auth::user();

            $pinjambarang->status = 'approve by '.$user->nama_lengkap;
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Peminjaman telah di approve.');

            return back();
        }
    }

    // BARANG KEMBALI

    public function barangKembali(Request $request)
    {

        $rowsBarang = $request->query('rowsBarang');
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Barang::where('nama_barang', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $pinjambarang = Pinjambarang::where('status', 'selesai')->whereIn('id_barang', $searchName)->paginate($rowsBarang);
            } else {
                $pinjambarang = Pinjambarang::where('status', 'selesai')->where('id_barang', '0')->paginate($rowsBarang);
            }
        } elseif ($search == null) {
            $pinjambarang = Pinjambarang::where('status', 'selesai')->paginate($rowsBarang);
        }

        return view('admin.datapeminjaman.index', [
            'barangKembali' => $pinjambarang,
            'rowsBarang' => $rowsBarang,
            'search' => $search,
        ]);
    }

    // BARANG BATAL

    public function barangBatal(Request $request)
    {
        $rowsBarang = $request->query('rowsBarang');
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Barang::where('nama_barang', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $pinjambarang = Pinjambarang::where('status', 'like', '%batal%')->whereIn('id_barang', $searchName)->paginate($rowsBarang);
            } else {
                $pinjambarang = Pinjambarang::where('status', 'like', '%batal%')->where('id_barang', '0')->paginate($rowsBarang);
            }
        } elseif ($search == null) {
            $pinjambarang = Pinjambarang::where('status', 'like', '%batal%')->paginate($rowsBarang);
        }

        return view('admin/datapeminjaman.index', [
            'barangBatal' => $pinjambarang,
            'rowsBarang' => $rowsBarang,
            'search' => $search,
        ]);
    }

    // USER

    // PINJAM BARANG

    public function pinjamBarang(Request $request)
    {
        $rowsBarang = $request->query('rowsBarang', 10);
        $role = Role::where('name', 'guru')->first();
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Barang::where('nama_barang', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $dataPinjam = Pinjambarang::where('id_user', Auth::user()->id)->whereIn('id_barang', $searchName)->paginate($rowsBarang);
            } else {
                $dataPinjam = Pinjambarang::where('id_user', Auth::user()->id)->where('id_barang', '0')->paginate($rowsBarang);
            }
        } elseif ($search == null) {
            $dataPinjam = Pinjambarang::where('id_user', Auth::user()->id)->paginate($rowsBarang);
        }

        return view('user.index', [
            'pinjambarang' => $dataPinjam,
            'rowsBarang' => $rowsBarang,
            'barang' => Barang::where('status', 'free')->where('stok', 1)->get(),
            'guru' => User::role($role)->get(),
            'search' => $search,
        ]);
    }

    // BATAL PINJAM
    public function batalPinjam(Request $request, $id)
    {
        $pinjambarang = Pinjambarang::find($id)->first();
        $barang = Barang::find($pinjambarang->id_barang)->first();

        if ($pinjambarang) {
            $barang->stok = 1;
            $barang->status = 'free';
            $barang->save();

            $pinjambarang->tgl_selesai = $request->tgl_selesai;
            $pinjambarang->wkt_selesai = $request->wkt_selesai;
            $pinjambarang->status = 'batal pinjam';
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Pinjaman telah di batalkan');

            return back();
        }
    }

    // KEMBALIKAN PINJAMAN
    public function kembaliPinjam(Request $request, $id)
    {
        $pinjambarang = Pinjambarang::find($id);
        $barang = Barang::find($pinjambarang->id_barang);

        if ($pinjambarang) {
            $barang->stok = 1;
            $barang->status = 'free';
            $barang->save();

            $pinjambarang->tgl_selesai = $request->tgl_selesai;
            $pinjambarang->wkt_selesai = $request->wkt_selesai;
            $pinjambarang->status = 'selesai';
            $pinjambarang->save();

            Alert::success('Berhasil!', 'Berhasil kembalikan pinjaman.');

            return back();
        }
    }

    public function kirimPinjaman(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_barang' => 'required',
            'nama_guru' => 'required',
            'password' => 'required',
            'tgl_mulai' => 'required',
            'wkt_mulai' => 'required',
            'lokasi' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error!', $validator->errors()->first());

            return back();
        }

        $barang = Barang::where('nama_barang', $request->nama_barang)->first();
        $guru = User::where('nama_lengkap', $request->nama_guru)->first();
        $user = Auth::user();
        if (Hash::check($request->password, $user->password) && $barang && $guru) {
            $barang->stok = 0;
            $barang->status = 'dipinjam';
            $barang->save();

            $pinjam = new Pinjambarang;
            $pinjam->id_barang = $barang->id;
            $pinjam->id_guru = $guru->id;
            $pinjam->id_user = $user->id;
            $pinjam->qty = 1;
            $pinjam->tgl_mulai = $request->tgl_mulai;
            $pinjam->wkt_mulai = $request->wkt_mulai;
            $pinjam->tgl_selesai = '0000-00-00';
            $pinjam->wkt_selesai = '00:00:00';
            $pinjam->lokasi_barang = $request->lokasi;
            $pinjam->status = 'menunggu';
            $pinjam->save();

            Alert::success('Berhasil!', 'Berhasil Pinjam Barang.');

            return back();
        } else {
            Alert::error('Error!', 'Data tidak dapat diproses atau passsword salah.');

            return back();
        }
    }
}
