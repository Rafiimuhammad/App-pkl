<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftaranpkl;
use App\Models\Pendaftaranseminarpkl;
use App\Models\User;

class PendaftaranpklController extends Controller
{
    public function pendaftaranpkl()
    {

        $data = Pendaftaranpkl::where('id_user', auth()->user()->id)->first();
        return view('mahasiswa.Pendaftaran-pkl', compact('data'));
    }

    public function tambahdatapendaftaranpkl()
    {
        $user = User::all();
        return view('mahasiswa.Tambah-data-pendaftaranpkl', compact('user'));
    }

    public function inputdatapendaftaranpkl(Request $request)
    {
        $file = $request->filepersyaratanpkl;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->filepersyaratanpkl->move('filepersyaratanpkl', $filename);

        Pendaftaranpkl::where("id_user", auth()->user()->id)
            ->update([
                'filepersyaratanpkl' => $filename,
                'judulpkl' => $request->judulpkl,
                'status' => 2
            ]);
        Pendaftaranseminarpkl::where("id_user", auth()->user()->id)
            ->update([
                'judulpkl' => $request->judulpkl,
            ]);
        return redirect()->route('pendaftaranpkl')->with('success', ' Data Berhasil Ditambahkan');
    }

    public function view($id)
    {
        $data = Pendaftaranpkl::find($id);

        return view('mahasiswa.viewpendaftaranpkl', compact('data'));
    }

    public function tampilkandatapendaftaranpkl($id)
    {
        $data = Pendaftaranpkl::find($id);
        return view('mahasiswa.Tampil-data-pendaftaranpkl', compact('data'));
    }

    public function updatedatapendaftaranpkl(Request $request, $id)
    {
        $edit = Pendaftaranpkl::find($id);
        $nmawal = $edit->filepersyaratanpkl;

        $data = [
            'nim' => $request['nim'],
            'nama' => $request['nama'],
            'email' => $request['email'],
            'filepersyaratanpkl' => $nmawal,
        ];
        $request->filepersyaratanpkl->move('filepersyaratanpkl', $nmawal);
        $edit->update($data);
        return redirect()->route('pendaftaranpkl')->with('success', ' Data Berhasil Diedit');
    }

    public function deletedatapendaftaranpkl($id)
    {
        $data = Pendaftaranpkl::find($id);
        $data->delete();
        return redirect()->route('pendaftaranpkl');
    }
}
