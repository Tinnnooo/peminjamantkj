<?php

namespace App\Http\Controllers;

use App\Models\Pinjamruangan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class PinjamRuanganController extends Controller
{
    // ADMIN

    // RUANGAN DIPINJAM

    public function ruanganDipinjam(Request $request)
    {
        $rowsRuangan = $request->query('rowsRuangan');
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Ruangan::where('nama_ruangan', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $pinjamRuangan = Pinjamruangan::where('status', '<>', 'selesai')->whereIn('id_ruangan', $searchName)->paginate($rowsRuangan);
            } else {
                $pinjamRuangan = Pinjamruangan::where('status', '<>', 'selesai')->where('id_ruangan', '0')->paginate($rowsRuangan);
            }
        } elseif ($search == null) {
            $pinjamRuangan = Pinjamruangan::where('status', '<>', 'selesai')->paginate($rowsRuangan);
        }

        return view('admin.datapeminjaman.index', [
            'ruanganDipinjam' => $pinjamRuangan,
            'rowsRuangan' => $rowsRuangan,
            'search' => $search,
        ]);
    }

    public function approvePinjamRuangan(Request $request, $id)
    {
        $pinjamRuangan = Pinjamruangan::find($id);

        if ($pinjamRuangan) {
            $user = Auth::user();

            $pinjamRuangan->status = 'approve by '.$user->nama_lengkap;
            $pinjamRuangan->save();

            Alert::success('Berhasil!', 'Peminjaman telah di approve.');

            return back();
        }
    }

    // RUANGAN KEMBALI

    public function ruanganKembali(Request $request)
    {
        $rowsRuangan = $request->query('rowsRuangan');
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Ruangan::where('nama_ruangan', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $pinjamRuangan = Pinjamruangan::where('status', 'selesai')->whereIn('id_ruangan', $searchName)->paginate($rowsRuangan);
            } else {
                $pinjamRuangan = Pinjamruangan::where('status', 'selesai')->where('id_ruangan', '0')->paginate($rowsRuangan);
            }
        } elseif ($search == null) {
            $pinjamRuangan = Pinjamruangan::where('status', 'selesai')->paginate($rowsRuangan);
        }

        return view('admin.datapeminjaman.index', [
            'ruanganKembali' => $pinjamRuangan,
            'rowsRuangan' => $rowsRuangan,
            'search' => $search,
        ]);
    }

    // USER

    public function pinjamRuangan(Request $request)
    {
        $rowsRuangan = $request->query('rowsRuangan');
        $role = Role::where('name', 'guru')->first();
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Ruangan::where('nama_ruangan', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $dataPinjam = Pinjamruangan::where('id_user', Auth::user()->id)->whereIn('id_ruangan', $searchName)->paginate($rowsRuangan);
            } else {
                $dataPinjam = Pinjamruangan::where('id_user', Auth::user()->id)->where('id_ruangan', '0')->paginate($rowsRuangan);
            }
        } elseif ($search == null) {
            $dataPinjam = Pinjamruangan::where('id_user', Auth::user()->id)->paginate($rowsRuangan);
        }

        return view('user.index', [
            'pinjamruangan' => $dataPinjam,
            'rowsRuangan' => $rowsRuangan,
            'ruangan' => Ruangan::where('status', 'free')->get(),
            'guru' => User::role($role)->get(),
            'search' => $search,
        ]);
    }

    public function batalkanPinjamRuangan(Request $request, $id)
    {
        $pinjamRuangan = Pinjamruangan::find($id);
        $ruangan = Ruangan::find($pinjamRuangan->id_ruangan);

        if ($pinjamRuangan) {
            $ruangan->status = 'free';
            $ruangan->save();

            $pinjamRuangan->tgl_selesai = $request->tgl_selesai;
            $pinjamRuangan->wkt_selesai = $request->wkt_selesai;
            $pinjamRuangan->status = 'batal pinjam';
            $pinjamRuangan->save();

            Alert::success('Berhasil!', 'Pinjaman telah di batalkan');

            return back();
        }
    }

    public function kembalikanRuangan(Request $request, $id)
    {
        $pinjamRuangan = Pinjamruangan::find($id);
        $ruangan = Ruangan::find($pinjamRuangan->id_ruangan);

        if ($pinjamRuangan) {
            $ruangan->status = 'free';
            $ruangan->save();

            $pinjamRuangan->tgl_selesai = $request->tgl_selesai;
            $pinjamRuangan->wkt_selesai = $request->wkt_selesai;
            $pinjamRuangan->status = 'selesai';
            $pinjamRuangan->save();

            Alert::success('Berhasil!', 'Berhasil kembalikan pinjaman.');

            return back();
        }
    }

    public function kirimPinjaman(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'nama_guru' => 'required',
            'password' => 'required',
            'tgl_mulai' => 'required',
            'wkt_mulai' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error!', $validator->errors()->first());

            return back();
        }

        $ruangan = Ruangan::where('nama_ruangan', $request->nama_ruangan)->first();
        $guru = User::where('nama_lengkap', $request->nama_guru)->first();
        $user = Auth::user();

        if (Hash::check($request->password, $user->password) && $ruangan && $guru) {
            $ruangan->status = 'dipinjam';
            $ruangan->save();

            $pinjam = new Pinjamruangan;
            $pinjam->id_ruangan = $ruangan->id;
            $pinjam->id_guru = $guru->id;
            $pinjam->id_user = $user->id;
            $pinjam->tgl_mulai = $request->tgl_mulai;
            $pinjam->wkt_mulai = $request->wkt_mulai;
            $pinjam->tgl_selesai = '0000-00-00';
            $pinjam->wkt_selesai = '00:00:00';
            $pinjam->status = 'menunggu';
            $pinjam->save();

            Alert::success('Berhasil!', 'Berhasil Pinjam Ruangan.');

            return back();
        } else {
            Alert::error('Error!', 'Data tidak dapat di proses atau password salah.');

            return back();
        }
    }
}
