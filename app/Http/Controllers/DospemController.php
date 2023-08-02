<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Logbook;
use App\Models\Pendaftaranseminarpkl;

class DospemController extends Controller
{
    public function laporan_mahasiswa()
    {
        $id_dosen = auth()->user()->dosen->id;

        $data = Logbook::whereHas('pendaftaranpkl', function ($query) use ($id_dosen) {
            $query->where('id_dosen1', $id_dosen)
                ->orWhere('id_dosen2', $id_dosen);
        })->with('pendaftaranpkl')->paginate(10);
        return view('dospem.laporan-mahasiswa', compact('data'));
    }

    public function detail_laporan_mahasiswa()
    {
        $data = Dosen::all();
        return view('dospem.detail-laporan-mahasiswa');
    }

    public function pengajuan_seminar()
    {
        $data = Pendaftaranseminarpkl::where('id_dosen1', auth()->user()->dosen->id)->orWhere('id_dosen2', auth()->user()->dosen->id)->orderBy('updated_at', 'desc')->get();

        return view('dospem.pengajuan-seminar', compact('data'));
    }

    public function ubah_status_seminar($id, $status)
    {
        $edit = Pendaftaranseminarpkl::find($id);

        $edit->update([
            'status' => $status == 'terima' ? '3' : '4'
        ]);
        return redirect('pengajuan-seminar')->with('success', ' Status Berhasil Diedit');
    }
}
