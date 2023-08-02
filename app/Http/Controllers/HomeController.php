<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaranpkl;
use App\Models\Logbook;
use App\Models\Pendaftaranseminarpkl;

class HomeController extends Controller
{
    public function index()
    {
        $id_dosen = 1;
//        $id_dosen = auth()->user()->dosen->id; *
        $data = [
            'Pendaftaranpkl' => Pendaftaranpkl::where('id_dosen1', $id_dosen)->orWhere('id_dosen2', $id_dosen)->count(),
            'Logbook' => Logbook::whereHas('pendaftaranpkl', function ($query) use ($id_dosen) {
                $query->where('id_dosen1', $id_dosen)
                    ->orWhere('id_dosen2', $id_dosen);
            })->count(),
            'Pendaftaranseminarpkl' => Pendaftaranseminarpkl::where('id_dosen1', $id_dosen)->orWhere('id_dosen2', $id_dosen)->count(),
        ];
        if (auth()->user() == null) return redirect("login");
        return view('layouts.master', compact('data'));
    }
}
