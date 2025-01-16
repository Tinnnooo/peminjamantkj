<?php

namespace App\Http\Controllers;

use App\Models\Ambilbahan;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AmbilBahanController extends Controller
{
    public function index(Request $request)
    {
        $rowsBahan = $request->query('rowsBahan', 10);
        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Bahan::where('nama_bahan', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $ambilbahan = Ambilbahan::whereIn('id_bahan', $searchName)->paginate($rowsBahan);
            } else {
                $ambilbahan = Ambilbahan::where('id_bahan', '0')->paginate($rowsBahan);
            }
        } elseif ($search == null) {
            $ambilbahan = Ambilbahan::paginate($rowsBahan);
        }

        return view('ambil_bahan.admin.index', [
            'ambil_bahan' => $ambilbahan,
            'rowsBahan' => $rowsBahan,
            'search' => $search,
        ]);
    }

    public function approveBahan($id)
    {
        $ambilbahan = Ambilbahan::find($id);

        if ($ambilbahan) {
            $ambilbahan->status = 'approve';
            $ambilbahan->save();

            Alert::success('Berhasil!', 'Permintaan telah di approve!');

            return back();
        }
    }

    public function ambilBahan(Request $request)
    {
        $rowsBahan = $request->query('rowsBahan', 10);

        $search = $request->input('search');

        if ($search !== null) {
            $searchLike = '%'.$search.'%';
            $searchName = Bahan::where('nama_bahan', 'like', $searchLike)->pluck('id');
            if ($searchName) {
                $dataAmbil = Ambilbahan::where('id_user', Auth::user()->id)->whereIn('id_bahan', $searchName)->paginate($rowsBahan);
            } else {
                $dataAmbil = Ambilbahan::where('id_user', Auth::user()->id)->where('id_bahan', '0')->paginate($rowsBahan);
            }
        } elseif ($search == null) {
            $dataAmbil = Ambilbahan::where('id_user', Auth::user()->id)->paginate($rowsBahan);
        }

        return view('ambil_bahan.admin.index', [
            'ambil_bahan' => $dataAmbil,
            'bahan' => Bahan::where('stok', '>=', 1)->get(),
            'rowsBahan' => $rowsBahan,
            'search' => $search,
        ]);
    }

    public function kirimAmbilBahan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_bahan' => 'required',
            'password' => 'required',
            'tgl_ambil' => 'required',
            'wkt_ambil' => 'required',
            'jumlah' => 'required',
            'untuk' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error!', $validator->errors()->first());

            return back();
        }

        $bahan = Bahan::where('nama_bahan', $request->nama_bahan)->first();
        $user = Auth::user();

        if (Hash::check($request->password, $user->password) && $bahan) {
            if ($request->jumlah > $bahan->stok) {
                Alert::error('Error!', 'Jumlah melebihi stok.');

                return back();
            } else {
                $ambilbahan = new Ambilbahan;
                $ambilbahan->id_bahan = $bahan->id;
                $ambilbahan->id_user = $user->id;
                $ambilbahan->tgl_ambil = $request->tgl_ambil;
                $ambilbahan->wkt_ambil = $request->wkt_ambil;
                $ambilbahan->qty = $request->jumlah;
                $ambilbahan->deskripsi = $request->untuk;
                $ambilbahan->status = 'menunggu';
                $ambilbahan->save();

                $bahan->stok = $bahan->stok - $request->jumlah;
                $bahan->save();

                Alert::success('Berhasil!', 'Berhasil Ambil Bahan.');

                return back();
            }
        } else {
            Alert::error('Error!', 'Data tidak dapat diproses atau passsword salah.');

            return back();
        }
    }

    public function batalkanPengambilan($id)
    {
        $ambilbahan = Ambilbahan::find($id);
        $bahan = Bahan::where('id', $ambilbahan->id_bahan)->first();

        if ($ambilbahan) {
            $ambilbahan->status = 'batal ambil';
            $ambilbahan->save();

            $bahan->stok = $bahan->stok + $ambilbahan->qty;
            $bahan->save();

            Alert::success('Berhasil!', 'Pengambilan telah di batalkan');

            return back();
        }
    }
}
