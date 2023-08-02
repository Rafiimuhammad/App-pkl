<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Pendaftaranpkl;
use App\Models\Pendaftaranseminarpkl;
use Illuminate\Http\Request;

class DatadosenController extends Controller
{
    public function index()
    {
        $data = Dosen::all();
        return view('admin.data-dosen', compact('data'));
    }

    public function penentuan_dosen()
    {
        $data = Pendaftaranpkl::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.penentuan-dosen', compact('data'));
    }

    public function ubah_status($id, $status)
    {
        Pendaftaranpkl::where('id', $id)->update([
            'status' => $status == 'setuju' ? "3" : "4"
        ]);
        return redirect("penentuan-dosen");
    }

    public function penentuan_dosen_edit($id)
    {
        $data = Dosen::all();
        return view('admin.penentuan-dosen-edit', compact('data'));
    }

    public function penentuan_dosen_update(Request $request)
    {
        $id_user = Pendaftaranpkl::where('id', $request->id)->first()->id_user;
        Pendaftaranpkl::where('id', $request->id)->update([
            'id_dosen1' => $request->id_dosen1,
            'id_dosen2' => $request->id_dosen2,
            'status' => '5'
        ]);
        Pendaftaranseminarpkl::where('id_user', $id_user)->update([
            'id_dosen1' => $request->id_dosen1,
            'id_dosen2' => $request->id_dosen2,
        ]);
        return redirect("penentuan-dosen");
    }
}
