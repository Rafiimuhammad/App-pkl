<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Logbook;
use App\Models\Pendaftaranpkl;
use App\Models\User;

class LogbookController extends Controller
{
    public function logbook()
    {
        $data = Logbook::with(["pendaftaranpkl" => function ($q) {
            $q->where('pendaftaranpkls.id_user', auth()->user()->id);
        }])->orderBy('updated_at', 'desc')->get();
        return view('mahasiswa.logbook', compact('data'));
    }

    public function tambahdatalogbook()
    {
        $user = User::all();
        return view('mahasiswa.Tambah-data-logbook');
    }

    public function inputdatalogbook(Request $request)
    {
        $id_pendaftaranpkl = Pendaftaranpkl::where('id_user', auth()->user()->id)->first()->id;

        $data = new Logbook();

        $file = $request->filelogbook;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $request->filelogbook->move('filelogbook', $filename);
        $data->filelogbook = $filename;

        $data->id_pendaftaranpkl = $id_pendaftaranpkl;
        $data->minggu = $request->minggu;

        $data->save();
        return redirect()->route('logbook')->with('success', ' Data Berhasil Ditambahkan');
    }

    public function view($id)
    {
        $data = Logbook::find($id);

        return view('mahasiswa.viewlogbook', compact('data'));
    }

    public function tampilkandatalogbook($id)
    {
        $data = Logbook::find($id);
        return view('mahasiswa.Tampil-data-logbook', compact('data'));
    }

    public function updatedatalogbook(Request $request, $id)
    {
        $edit = Logbook::find($id);
        $nmawal = $edit->filelogbook;

        $data = [
            'minggu' => $request['minggu'],
            'filelogbook' => $nmawal,
        ];
        $request->filelogbook->move('filelogbook', $nmawal);
        $edit->update($data);
        return redirect()->route('logbook')->with('success', ' Data Berhasil Diedit');
    }

    public function ubah_status_logbook($id, $status, $dosen)
    {
        if ($dosen == "dosen1") {
            Logbook::where('id', $id)
                ->update(['status' => $status == 'terima' ? '1' : '2']);
        } else {
            Logbook::where('id', $id)
                ->update(['status1' => $status == 'terima' ? '1' : '2']);
        }

        return redirect('laporan-mahasiswa')->with('success', ' Status Berhasil Diedit');
    }

    public function deletedatalogbook($id)
    {
        $data = Logbook::find($id);
        $data->delete();
        if (auth()->user()->level == "Dospem") {
            return redirect('laporan-mahasiswa');
        }
        return redirect()->route('logbook');
    }
}
