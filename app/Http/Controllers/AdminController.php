<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pinjambarang;
use App\Models\Pinjamruangan;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(Request $request)
    {

        $rowsBarang = $request->query('rowsBarang', 10);
        $rowsRuangan = $request->query('rowsRuangan', 10);

        $pinjambarang = Pinjambarang::where('status', 'menunggu')->orWhere('status', 'like', '%diizinkan%')->orWhere('status', 'like', '%approve%')->orderBy('status')->paginate($rowsBarang, ['*'], 'barang');
        $pinjamruangan = Pinjamruangan::where('status', 'menunggu')->orWhere('status', 'like', '%approve%')->orderBy('status')->paginate($rowsRuangan, ['*'], 'ruangan');

        $countBarang = Pinjambarang::where('status', 'menunggu')->orWhere('status', 'like', '%diizinkan%')->orWhere('status', 'like', '%approve%')->get();
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ruanganApprove($id)
    {

        $user = Auth::user();

        $pinjamruangan = Pinjamruangan::find($id);
        $pinjamruangan->status = 'approve by '.$user->nama_lengkap;
        $pinjamruangan->save();

        return redirect('/dashboard/admin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function barangApprove($id)
    {

        $user = Auth::user();

        $pinjambarang = Pinjambarang::find($id);
        $pinjambarang->status = 'approve by '.$user->nama_lengkap;
        $pinjambarang->save();

        return redirect('/dashboard/admin');
    }
}
