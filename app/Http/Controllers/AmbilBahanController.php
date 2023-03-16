<?php

namespace App\Http\Controllers;

use App\Models\Ambilbahan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AmbilBahanController extends Controller
{
    public function index(Request $request){
        $rowsBahan = $request->query('rowsBahan', 10);

        return view('ambil_bahan.admin.index', [
            'ambil_bahan' => Ambilbahan::paginate($rowsBahan),
            'rowsBahan' => $rowsBahan,
        ]);
    }

    public function approveBahan($id){
        $ambilbahan = Ambilbahan::find($id);

        if($ambilbahan){
            $ambilbahan->status = 'approve';
            $ambilbahan->save();

            Alert::success('Berhasil!', 'Permintaan telah di approve!');
            return back();
        }
    }
}
