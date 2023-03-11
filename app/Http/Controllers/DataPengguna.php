<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class DataPengguna extends Controller
{
    public function index(Request $request){

        $rowsUser = $request->query('rowsUser', '10');

        return view('admin.pengguna.index', [
            'users' => User::paginate($rowsUser),
            'rowsUser' => $rowsUser,
        ]);
    }

    public function hapusPengguna($id){
        $user = User::find($id);
        if($user){
            $user->delete();
            return redirect()->back();
        }
    }

    public function gantiPassword(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8',
        ]);

        if($validator->fails()){
            Alert::error('Error!', 'Password minimal 8 huruf / angka!');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
            $user = User::find($id);
    
            if ($user) {
                $user->password = bcrypt($request->password);
                $user->save();
                Alert::success('Berhasil!', 'Password berhasil diubah!');
                return redirect()->back();
            } else {
                Alert::error('Error!', 'User tidak ditemukan!');
                return redirect()->back();
            }
        }

        public function editPengguna(Request $request, $id){
            $validator = Validator::make($request->all(),[
                'nama_lengkap' => 'required',
                'email' => 'required|email:dns',
                'nohp' => 'required',
                'level' => 'required',
            ]);

            if($validator->fails()){
                Alert::error('Error!', 'Ada kesalahan dalam pengubahan data!');
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user = User::find($id);

            if($user){
                $user->nama_lengkap = $request->nama_lengkap;
                $user->email = $request->email;
                $user->nohp = $request->nohp;
                if($request->level == 'admin'){
                    $user->syncRoles(['admin']);
                } else if ($request->level == 'guru'){
                    $user->syncRoles(['guru']);
                } else if ($request->level == 'user'){
                    $user->syncRoles(['user']);
                }
                $user->save();

                Alert::success('Berhasil!', 'Data pengguna di ubah!');
                return redirect()->back();
            }else {
                Alert::error('Error!', 'User tidak ditemukan!');
                return redirect()->back();
            }
        }
}
