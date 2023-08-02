<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSeminar;
use App\Models\Ruangan;
use App\Models\SeminarWaktu;
use Illuminate\Http\Request;

class RuanganWaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ruangan = Ruangan::orderBy('updated_at', 'desc')->get();
        $waktu = SeminarWaktu::orderBy('hari', 'desc')->orderBy('waktu_mulai', 'asc')->get();
        return view('admin.ruangan-waktu', compact('ruangan', 'waktu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_ruangan()
    {
        return view('admin.tambah-ruangan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_waktu()
    {
        return view('admin.tambah-waktu');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_ruangan(Request $request)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
        ]);

        try {
            Ruangan::create([
                'nama_ruangan' => $request->input('nama_ruangan'),
            ]);

            return redirect('/ruangan-waktu');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan ruangan.')->withInput();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_waktu(Request $request)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        try {
            $waktu = new SeminarWaktu();
            $waktu->hari = $request->input('hari');
            $waktu->waktu_mulai = $request->input('waktu_mulai');
            $waktu->waktu_selesai = $request->input('waktu_selesai');
            $waktu->save();

            return redirect('ruangan-waktu')->with('success', 'Data waktu berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect('tambah-waktu')->with('error', 'Terjadi kesalahan saat menyimpan data waktu.')->withInput();
        }
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
    public function edit_ruangan($id)
    {
        $ruangan = Ruangan::findOrFail($id);
        return view('admin.edit-ruangan', compact('ruangan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_waktu($id)
    {
        $waktu = SeminarWaktu::findOrFail($id);
        return view('admin.edit-waktu', compact('waktu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_ruangan(Request $request, $id)
    {
        $request->validate([
            'nama_ruangan' => 'required|string|max:255',
        ]);

        try {
            $ruangan = Ruangan::findOrFail($id);

            $ruangan->update([
                'nama_ruangan' => $request->input('nama_ruangan'),
            ]);

            $tomorrow = now()->addDay();
            PenjadwalanSeminar::where('tanggal', '>=', $tomorrow->format('Y-m-d 00:00:00'))->delete();
            return redirect('ruangan-waktu')->with('success', 'Ruangan berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect('edit-ruangan/' . $id)->with('error', 'Terjadi kesalahan saat memperbarui ruangan.')->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_waktu(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i',
            'waktu_selesai' => 'required|date_format:H:i|after:waktu_mulai',
        ]);

        try {
            $waktu = SeminarWaktu::findOrFail($id);

            $waktu->hari = $request->input('hari');
            $waktu->waktu_mulai = $request->input('waktu_mulai');
            $waktu->waktu_selesai = $request->input('waktu_selesai');

            $waktu->save();

            $tomorrow = now()->addDay();
            PenjadwalanSeminar::where('tanggal', '>=', $tomorrow->format('Y-m-d 00:00:00'))->delete();
            return redirect('ruangan-waktu')->with('success', 'Data waktu berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect('edit-waktu/' . $id)->with('error', 'Terjadi kesalahan saat memperbarui data waktu.')->withInput();
        }
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
    public function delete_ruangan($id)
    {
        try {
            $ruangan = Ruangan::findOrFail($id);

            $ruangan->delete();

            $tomorrow = now()->addDay();
            PenjadwalanSeminar::where('tanggal', '>=', $tomorrow->format('Y-m-d 00:00:00'))->delete();
            return redirect()->back()->with('success', 'Ruangan berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus ruangan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete_waktu($id)
    {
        try {
            $ruangan = SeminarWaktu::findOrFail($id);

            $ruangan->delete();

            $tomorrow = now()->addDay();
            PenjadwalanSeminar::where('tanggal', '>=', $tomorrow->format('Y-m-d 00:00:00'))->delete();
            return redirect()->back()->with('success', 'Data waktu berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data waktu.');
        }
    }
}
