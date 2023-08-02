<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DatamahasiswaController extends Controller
{
    public function index(){
        $data = Mahasiswa::paginate(10);
        return view('admin.data-mahasiswa',compact('data'));
    }
}
