<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Pendaftaranpkl;
use App\Models\Pendaftaranseminarpkl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.Login-aplikasi');
    }

    public function tampilanregister()
    {
        return view('auth.Register');
    }

    public function registeruser(Request $request)
    {
        $id_datamahasiswa = null;
        $id_dosen = null;
        $id_user = null;

        if ($request->level == "Mahasiswa") {
            $id_datamahasiswa = Mahasiswa::create([
                'nim' => $request->nimataunidn,
                'nama' => $request->nama,
            ])->id;
        } else {
            $id_dosen = Dosen::create([
                'nidn' => $request->nimataunidn,
                'namadosen' => $request->nama
            ]);
        }

        $id_user = User::create([
            'nimataunidn' => $request->nimataunidn,
            'nama' => $request->nama,
            'email' => $request->email,
            'level' => $request->level,
            'id_datamahasiswa' => $id_datamahasiswa,
            'id_dosen' => $id_dosen,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),
        ])->id;

        if ($request->level == "Mahasiswa") {
            Pendaftaranpkl::create([
                'id_user' => $id_user,
            ])->id;
            Pendaftaranseminarpkl::create([
                'id_user' => $id_user,
            ])->id;
        }

        return view('auth.Login-aplikasi');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }

    public function datauser()
    {
        $data = User::all();
        return view('admin.data-user', compact('data'));
    }

    public function tambahdatauser()
    {
        return view('admin.tambah-data-user');
    }

    // public function tampilkandatauser($id){
    //     $data = User::find($id);
    //     return view('Login.Tampil-data', compact('data'));
    // }

    // public function updatedatauser(Request $request, $id){
    //     $data = User::find($id);
    //     $data->update($request->all());
    //     return redirect()->route('datauser')->with('success',' Data Berhasil Diedit');
    // }

    // public function deletedatauser($id){
    //     $data = User::find($id);
    //     $data->delete();
    //     return redirect()->route('datauser');
    // }
}
