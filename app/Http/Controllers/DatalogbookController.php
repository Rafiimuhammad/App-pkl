<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\User;

class DatalogbookController extends Controller
{
    public function index()
    {

        $data = Logbook::whereIn('status', [0])->orderBy('updated_at', 'desc')->get();
        return view('admin.Logbook', compact('data'));
    }

    public function ceklogbook($id)
    {
        $data = Logbook::find($id);
        return view('admin.Tampil-data-logbook', compact('data'));
    }

    public function approvals(Request $request, $id)
    {
        $data = Logbook::find($id);
        $data->approvals($request->all());
        $data->status = 1;
        $data->save();
        return redirect('/datalogbook');
    }

    public function reject(Request $request, $id)
    {
        $data = Logbook::find($id);
        $data->reject($request->all());
        $data->status = 2;
        $data->save();
        return redirect('/datalogbook');
    }
}
