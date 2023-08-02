<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaranpkl;
use Illuminate\Http\Request;
use App\Models\Pendaftaranseminarpkl;
use App\Models\User;

class DatapendaftaranseminarpklController extends Controller
{
    public function index()
    {

        $data = Pendaftaranseminarpkl::whereIn('status', [0])->get();
        return view('admin.pendaftaran-seminar', compact('data'));
    }

    public function cekpengajuanpkl($id)
    {
        $data = Pendaftaranpkl::find($id);
        return view('admin.Tampil-data-pendaftaranpkl', compact('data'));
    }

    public function approvals(Request $request, $id)
    {
        $data = Pendaftaranpkl::find($id);
        $data->approvals($request->all());
        $data->status = 1;
        $data->save();
        return redirect('/datapendaftaranpkl');
    }

    public function reject(Request $request, $id)
    {
        $data = Pendaftaranpkl::find($id);
        $data->reject($request->all());
        $data->status = 2;
        $data->save();
        return redirect('/datapendaftaranpkl');
    }
}
