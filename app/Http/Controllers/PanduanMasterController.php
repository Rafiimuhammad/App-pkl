<?php

namespace App\Http\Controllers;

use App\Models\FormBimbingan;
use App\Models\PanduanPedoman;
use Illuminate\Http\Request;

class PanduanMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_pedoman = PanduanPedoman::first();
        $data_bimbingan = FormBimbingan::first();
        return view('admin.panduan-master', compact('data_pedoman', 'data_bimbingan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_panduan(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:25000',
        ]);

        $path = $request->file('file')->store('public');
        $fileName = basename($path);

        PanduanPedoman::create([
            'file' => $fileName,
        ]);

        return back()->with('success', 'File berhasil disimpan.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload_bimbingan(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf|max:25000',
        ]);

        $path = $request->file('file')->store('public');
        $fileName = basename($path);

        FormBimbingan::create([
            'file' => $fileName,
        ]);

        return back()->with('success', 'File berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
