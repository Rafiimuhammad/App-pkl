<?php

namespace App\Http\Controllers;

use App\Models\FormBimbingan;
use App\Models\PanduanPedoman;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function panduanPenggunaan()
    {
        $bimbingan = FormBimbingan::first();
        $pedoman = PanduanPedoman::first();
        return view('mahasiswa.panduan-penggunaan', compact('bimbingan', 'pedoman'));
    }
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
