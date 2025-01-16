<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    public function tambahRuangan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|mimes:png,jpeg,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error!', $validator->errors()->first());

            return back();
        }

        $nama_file = time().'_'.$request->file('foto')->getClientOriginalName();
        $request->file('foto')->storeAs('images', $nama_file);

        $path_file = public_path('storage/images/'.$nama_file);

        $image = Image::make($path_file);
        $image->resize(448, 200);
        $image->save($path_file);

        $data = [
            'nama_ruangan' => $request->nama_ruangan,
            'deskripsi' => $request->deskripsi,
            'foto' => $nama_file,
        ];

        Ruangan::create($data);

        Alert::success('Success!', 'Data Ruangan telah ditambah!');

        return back();
    }

    public function editRuangan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_ruangan' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image|file|mimes:png,jpeg,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            Alert::error('Validation Error!', $validator->errors()->first());

            return back();
        }

        $ruangan = Ruangan::find($id);
        $nama_file = $ruangan->foto;

        $ruangan->nama_ruangan = $request->nama_ruangan;
        $ruangan->deskripsi = $request->deskripsi;

        if ($request->hasFile('foto')) {
            $new_file = time().'_'.$request->file('foto')->getClientOriginalName();
            $request->file('foto')->storeAs('images', $new_file);
            $path_file = public_path('storage/images/'.$new_file);

            $image = Image::make($path_file);
            $image->resize(448, 200);
            $image->save($path_file);

            Storage::delete('images/'.$nama_file);
        }

        $ruangan->foto = $new_file;
        $ruangan->save();

        Alert::success('Berhasil!', 'Data berhasil diubah.');

        return back();
    }

    public function hapusRuangan($id)
    {
        $ruangan = Ruangan::find($id);

        if ($ruangan) {
            $ruangan->delete();
            Storage::delete('images/'.$ruangan->foto);

            Alert::success('Berhasil!', 'Ruangan telah di hapus.');

            return back();
        }
    }
}
