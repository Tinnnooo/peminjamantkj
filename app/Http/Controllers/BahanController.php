<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BahanController extends Controller
{
    public function tambahBahan(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_bahan' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|mimes:png,jpeg,jpg|max:2048',
        ]);

        if($validator->fails()){
            Alert::error('Validation Erro!', $validator->errors()->first());
            return back();
        }

        $nama_file = time()."_".$request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('images', $nama_file);
        $path_file = public_path('storage/images/'.$nama_file);
        $image = Image::make($path_file);
        $image->resize(448,200);
        $image->save($path_file);

        $data = [
            'nama_bahan' => $request->nama_bahan,
            'stok' => $request->stok,
            'deskripsi' => $request->deskripsi,
            'foto' => $nama_file,
        ];

        Bahan::create($data);

        Alert::success('Berhasil!', 'Data Bahan telah di tambah.');
        return back();
    }

    public function editBahan(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'nama_bahan' => 'required',
            'stok' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if($validator->fails()){
            Alert::error('Validation Error!', $validator->errors()->first());
            return back();
        }

        $bahan = Bahan::find($id);
        $nama_file = $bahan->foto;

        $bahan->nama_bahan = $request->nama_bahan;
        $bahan->stok = $request->stok;
        $bahan->deskripsi = $request->deskripsi;

        if($request->hasFile('foto')){
            $new_file = time()."_".$request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('images',$new_file);
            $path_file = public_path('storage/images/'.$new_file);
            
            $image = Image::make($path_file);
            $image->resize(448, 200);
            $image->save($path_file);

            Storage::delete('images/'.$bahan->foto);
        }

        $bahan->foto = $new_file;
        $bahan->save();

        Alert::success('Berhasil!', 'Data Bahan telah di ubah.');
        return back();
    }

    public function hapusBahan($id){
        $bahan = Bahan::find($id);

        if($bahan){
            Storage::delete('images/'.$bahan->foto);

            $bahan->delete();

            Alert::success('Berhasil!', 'Data Bahan telah di hapus.');
            return back();
        }
    }
}
