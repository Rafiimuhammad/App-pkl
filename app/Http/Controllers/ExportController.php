<?php

namespace App\Http\Controllers;

use App\Models\PenjadwalanSeminar;
use App\Models\User;
use Dompdf\Dompdf;

class ExportController extends Controller
{
    public function exportPDF()
    {
        $data = [
            'title' => 'JADWAL SEMINAR PKL PROGRAM STUDI S1 INFORMATIKA FAKULTAS TEKNIK UNIVERSITAS MUHAMMADIYAH BANJARMASIN 2023',
            'jadwalSeminar' => PenjadwalanSeminar::orderBy('tanggal')->get()
        ];

        $dompdf = new Dompdf();

        $html = view('pdf.exportPdf', $data)->render(); // Assuming you have a Blade template in resources/views/pdf/template.blade.php

        $dompdf->loadHtml($html);

        $dompdf->setPaper('A4', 'landscape');

        $dompdf->render();

        $filename = 'Jadwal Seminar Mahasiswa.pdf';

        return $dompdf->stream($filename);
    }
}
