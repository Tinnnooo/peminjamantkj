<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\User;
use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Pinjambarang;
use Illuminate\Http\Request;
use App\Models\Pinjamruangan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    //

    public function index(){
        $countBarang = Pinjambarang::where('status', 'menunggu')->orWhere('status','like', '%diizinkan%')->orWhere('status', 'like', '%approve%')->get();
        $countRuangan = Pinjamruangan::where('status', 'menunggu')->orWhere('status', 'like', '%approve%')->get();
        return view('admin.index', [
            'barang' => Barang::all(),
            'ruangan' => Ruangan::all(),
            'user' => User::all(),
            'countBarang' => count($countBarang),
            'countRuangan' => count($countRuangan),
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
