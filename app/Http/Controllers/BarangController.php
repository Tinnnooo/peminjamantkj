<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    //

    public function tambahBarang(Request $request){
        $validator = Validator::make($request->all(), [
            "nama_barang" => "required",
            "stok" => "required",
            "status" => "required",
            "deskripsi" => "required",
            "foto" => "required|image|mimes:jpeg,png,jpg|max:1024",
        ]);

        if($validator->fails()){
            Alert::error("Validation Error!", $validator->errors()->first());
            return back();
        }

        $nama_file = time()."_".$request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('images', $nama_file);

        $path_file = public_path('storage/images/'.$nama_file);

        $image = Image::make($path_file);
        $image->resize(448, 200);
        $image->save($path_file);

        $data = [
            "nama_barang" => $request->nama_barang,
            "stok" => $request->stok,
            "status" => $request->status,
            "deskripsi" => $request->deskripsi,
            "foto" => $nama_file,
        ];

        Barang::create($data);

        Alert::success('Success', 'Data Barang telah ditambah!');
        return back();
    }

    public function editBarang(Request $request, $id){
        $validator = Validator::make($request->all(), [
            "nama_barang" => "required",
            "stok" => "required",
            "deskripsi" => "required",
            "status" => "required",
        ]);

        if($validator->fails()){
            Alert::error("Error Validation!", $validator->errors()->first());
            return back();
        }

        $barang = Barang::find($id);

        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->deskripsi = $request->deskripsi;
        $barang->status = $request->status;
        $barang->save();

        Alert::success('Berhasil!', 'Data Berhasil diubah.');
        return back();
    }

    public function updateFoto(Request $request, $id){
        $validator = Validator::make($request->all(),[
            "foto" => "required|image|mimes:png,jpg,jpeg|max:2048",
        ]);

        if($validator->fails()){
            Alert::error("Validation error!", $validator->errors()->first());
            return back();
        }

        $brng = Barang::find($id);
        $nama_file = $brng->foto;

        if($request->hasFile('foto')){
            $nama_file = time()."_".$request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('images', $nama_file);
            $path_file = public_path('storage/images/'.$nama_file);

            $image = Image::make($path_file);
            $image->resize(448, 200);
            $image->save($path_file);

            Storage::delete('images/'.$brng->foto);
        }

        $brng->foto = $nama_file;
        $brng->save();

        Alert::success('Berhasil!', 'Foto barang telah diubah!');
        return back();
    }

    public function hapusBarang($id){
        $barang = Barang::find($id);
        if($barang){

            Storage::delete('images/'.$barang->foto);

            $barang->delete();
            Alert::success("Berhasil!", "Barang telah di hapus.");
            return back();
        }
    }
}
