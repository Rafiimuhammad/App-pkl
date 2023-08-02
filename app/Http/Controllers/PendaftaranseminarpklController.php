<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Pendaftaranseminarpkl;

class PendaftaranseminarpklController extends Controller
{
    public function pendaftaranseminarpkl()
    {

        $data = Pendaftaranseminarpkl::where('id_user', auth()->user()->id)->first();
        return view('mahasiswa.Pendaftaran-seminar', compact('data'));
    }

    public function tambahdatapendaftaranseminar()
    {

        return view('mahasiswa.Tambah-data-pendaftaranseminar');
    }

    public function inputdatapendaftaranseminar(Request $request)
    {
        $pendaftaranseminar = Pendaftaranseminarpkl::where('id_user', $request->id_user)->first();

        $file1 = $request->filelogbook;
        if ($file1 != null) {
            $filename1 = time() . '.' . $file1->getClientOriginalExtension();
            $file1->move('filelogbookseminar', $filename1);
        } else {
            $filename1 = $pendaftaranseminar->filelogbook;
        }

        $file2 = $request->fileproposal;
        if ($file2 != null) {
            $filename2 = time() . '.' . $file2->getClientOriginalExtension();
            $file2->move('fileproposal', $filename2);
        } else {
            $filename2 = $pendaftaranseminar->fileproposal;
        }

        $file3 = $request->filebimbingan;
        if ($file3 != null) {
            $filename3 = time() . '.' . $file3->getClientOriginalExtension();
            $file3->move('filebimbingan', $filename3);
        } else {
            $filename3 = $pendaftaranseminar->filebimbingan;
        }

        Pendaftaranseminarpkl::where("id_user", auth()->user()->id)
            ->update([
                'filelogbook' => $filename1,
                'fileproposal' => $filename2,
                'filebimbingan' => $filename3,
                'status' => 2,
            ]);

        return redirect()->route('pendaftaranseminarpkl')->with('success', ' Data Berhasil Ditambahkan');
    }

    public function view($id)
    {
        $data = Pendaftaranseminarpkl::find($id);

        return view('mahasiswa.viewlogbookseminar', compact('data'));
    }

    public function viewproposal($id)
    {
        $data = Pendaftaranseminarpkl::find($id);

        return view('mahasiswa.viewproposal', compact('data'));
    }

    public function viewbimbingan($id)
    {
        $data = Pendaftaranseminarpkl::find($id);

        return view('mahasiswa.viewbimbingan', compact('data'));
    }

    public function tampilkandatapendaftaranseminar($id)
    {
        $data = Pendaftaranseminarpkl::find($id);
        return view('mahasiswa.Tampil-data-pendaftaranseminar', compact('data'));
    }

    public function updatedatapendaftaranseminar(Request $request, $id)
    {
        $edit = Pendaftaranseminarpkl::find($id);
        $nmawal = $edit->filelogbook;
        $awal = $edit->fileproposal;


        $data = [
            'nim' => $request['nim'],
            'nama' => $request['nama'],
            'email' => $request['email'],
            'judulpkl' => $request['judulpkl'],
            'dosenpembimbing' => $request['dosenpembimbing'],
            'filelogbook' => $nmawal,
            'fileproposal' => $nmawal,
        ];
        $request->filelogbook->move('filelogbookseminar', $nmawal);
        $request->fileproposal->move('fileproposal', $awal);
        $edit->update($data);
        return redirect()->route('pendaftaranseminarpkl')->with('success', ' Data Berhasil Diedit');
    }

    public function deletedatapendaftaranseminar($id)
    {
        $data = Pendaftaranseminarpkl::find($id);
        $data->delete();
        return redirect()->route('pendaftaranseminarpkl');
    }
}
