<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Pendaftaranseminarpkl;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\PenjadwalanSeminar;
use App\Models\Ruangan;
use App\Models\SeminarWaktu;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Carbon\CarbonTimeZone;
use Illuminate\Support\Arr;

class JadwalSeminarController extends Controller
{
    public function index()
    {
        $data = PenjadwalanSeminar::orderBy('tanggal', 'desc')->get();
        $pendaftaranseminarpklId = Pendaftaranseminarpkl::where('id_user', auth()->user()->id)->value('id');
        $penjadwalanSeminar = PenjadwalanSeminar::where('id_pendaftaranseminarpkl', $pendaftaranseminarpklId)->get();
        $getIdDosen = User::where('id', auth()->user()->id)->value('id_dosen');
        $seminar_waktu = SeminarWaktu::all();
        $jadwalDosen = PenjadwalanSeminar::where('id_dosen_penguji1', $getIdDosen)
            ->orWhere('id_dosen_penguji2', $getIdDosen)
            ->get();
        if (auth()->user()->level == "Koordinator") {
            return view('admin.jadwal-seminar', compact('data'));
        } elseif (auth()->user()->level == "Mahasiswa") {
            if ($penjadwalanSeminar->isEmpty()) {
                $penjadwalanSeminar = "No Data";
            }
            return view('mahasiswa.jadwal-seminar', compact('penjadwalanSeminar'));
        } else {
            if ($jadwalDosen->isEmpty()) {
                $jadwalDosen = "No Data";
            }
            return view('dospem.jadwal-seminar', compact('jadwalDosen'));
        }
    }

    public function generate_jadwal()
    {
        $ruangan_data = Ruangan::all();
        $all_dosen_ids = Dosen::pluck('id')->toArray();
        $pendaftar_seminar = Pendaftaranseminarpkl::where('status', 3)->get();

        foreach ($pendaftar_seminar as $pendaftar) {
            $check_jadwal = $this->check_jadwal($pendaftar->id);

            $dosen_ids = $this->remove_dospem_ids($all_dosen_ids, $pendaftar->id_dosen1, $pendaftar->id_dosen2);

            if (!$check_jadwal) {
                $jadwal_available = $this->getAvailableDays($ruangan_data->count());
                $durasi = $jadwal_available['time'];
                $jadwal_mulai = $jadwal_available['date'];

                foreach ($ruangan_data as $ruanganObj) {
                    $ruangan = $ruanganObj->nama_ruangan;

                    $jadwal_ruangan = $this->check_jadwal_ruangan($ruangan, $jadwal_mulai);

                    $last_id = $this->get_last_id_jadwal_seminar() + 1;
                    if ($jadwal_ruangan) {
                        continue;
                    } else {
                        $dosen_ids_to_remove = $this->get_dosen_ids_from_jadwal_seminar($ruangan, $jadwal_mulai);

                        $dosen_ids = $this->remove_dosen_ids($dosen_ids, $dosen_ids_to_remove);

                        $random_dosen_penguji_1 = $this->get_random_dosen($dosen_ids);
                        $dosen_ids = $this->remove_dosen_id($dosen_ids, $random_dosen_penguji_1);

                        $random_dosen_penguji_2 = $this->get_random_dosen($dosen_ids);

                        $this->create_jadwal_seminar($pendaftar->id, $ruangan, $jadwal_mulai, $durasi . ' menit', $random_dosen_penguji_1, $random_dosen_penguji_2, $last_id);
                        break;
                    }
                }
            }
        }

        return redirect('jadwal-seminar')->with('success', 'Jadwal Berhasil Digenerate');
    }

    private function check_jadwal($pendaftar_id)
    {
        return PenjadwalanSeminar::where('id_pendaftaranseminarpkl', $pendaftar_id)->exists();
    }

    private function remove_dospem_ids($dosen_ids, $dosen_id1, $dosen_id2)
    {
        $dosen_ids = array_values($dosen_ids);
        unset($dosen_ids[array_search($dosen_id1, $dosen_ids)]);
        unset($dosen_ids[array_search($dosen_id2, $dosen_ids)]);

        return $dosen_ids;
    }

    private function check_jadwal_ruangan($ruangan, $tanggal)
    {
        return PenjadwalanSeminar::where('ruangan', $ruangan)->where('tanggal', $tanggal)->exists();
    }

    private function get_dosen_ids_from_jadwal_seminar($ruangan, $tanggal)
    {
        $jadwalSeminar = PenjadwalanSeminar::where('ruangan', $ruangan)->where('tanggal', $tanggal)->get();
        $dosen_ids = [];
        foreach ($jadwalSeminar as $data) {
            $dosen_ids[] = $data->id_dosen_penguji1;
            $dosen_ids[] = $data->id_dosen_penguji2;
        }

        return $dosen_ids;
    }

    private function get_last_id_jadwal_seminar()
    {
        $jadwal_seminar = PenjadwalanSeminar::orderBy('id', 'desc')->first();
        if ($jadwal_seminar) {
            return $jadwal_seminar->id;
        }
        return 0;
    }

    private function remove_dosen_ids($dosen_ids, $dosen_ids_to_remove)
    {
        $dosen_ids = array_values($dosen_ids);
        foreach ($dosen_ids_to_remove as $dosen_id) {
            unset($dosen_ids[array_search($dosen_id, $dosen_ids)]);
        }

        return $dosen_ids;
    }

    private function get_random_dosen($dosen_ids)
    {
        return Arr::random($dosen_ids);
    }

    private function remove_dosen_id($dosen_ids, $dosen_id)
    {
        $dosen_ids = array_values($dosen_ids);
        unset($dosen_ids[array_search($dosen_id, $dosen_ids)]);

        return $dosen_ids;
    }

    private function create_jadwal_seminar($pendaftar_id, $ruangan, $tanggal, $durasi, $dosen_penguji1, $dosen_penguji2, $group_id)
    {
        PenjadwalanSeminar::create([
            'id_pendaftaranseminarpkl' => $pendaftar_id,
            'ruangan' => $ruangan,
            'tanggal' => $tanggal,
            'durasi' => $durasi,
            'id_dosen_penguji1' => $dosen_penguji1,
            'id_dosen_penguji2' => $dosen_penguji2,
            'group_id' => $group_id
        ]);
    }



    public function show($group_id)
    {
        $data['penjadwalanseminar'] = PenjadwalanSeminar::where('group_id', $group_id)->get();
        $data['mahasiswa'] = Mahasiswa::all();
        return view('admin.detail-jadwal-seminar', compact('data'));
    }

    public function edit($group_id)
    {
        $data['penjadwalanseminar'] = PenjadwalanSeminar::where('group_id', $group_id)->get();
        $data['pendaftaranseminarpkl'] = Pendaftaranseminarpkl::all();
        $data['mahasiswa'] = Mahasiswa::all();
        $data['dosen'] = Dosen::all();
        return view('admin.edit-jadwal-seminar', compact('data'));
    }

    public function tambah()
    {
        $data['pendaftaranseminarpkl'] = Pendaftaranseminarpkl::all();
        $data['mahasiswa'] = Mahasiswa::all();
        $data['dosen'] = Dosen::all();
        return view('admin.tambah-jadwal-seminar', compact('data'));
    }

    public function store(Request $request)
    {
        $group_id = PenjadwalanSeminar::orderBy('group_id', 'desc')->first();

        if ($group_id) {
            $group_id = PenjadwalanSeminar::orderBy('group_id', 'desc')->first()->group_id + 1;
        } else {
            $group_id = 1;
        }

        foreach ($request->mahasiswa as $value) {
            PenjadwalanSeminar::create([
                'id_pendaftaranseminarpkl' => $value,
                'ruangan' => $request->ruangan,
                'tanggal' => $request->tanggal,
                'durasi' => $request->durasi,
                'id_dosen_penguji1' => $request->id_dosen,
                'id_dosen_penguji2' => $request->id_dosen2,
                'group_id' => $group_id
            ]);
        }
        return redirect('jadwal-seminar')->with('success', ' Data Berhasil Ditambah');
    }

    public function update($group_id, Request $request)
    {
        PenjadwalanSeminar::where('group_id', $group_id)->delete();
        foreach ($request->mahasiswa as $value) {
            PenjadwalanSeminar::create([
                'id_pendaftaranseminarpkl' => $value,
                'ruangan' => $request->ruangan,
                'tanggal' => $request->tanggal,
                'durasi' => $request->durasi,
                'id_dosen_penguji1' => $request->id_dosen,
                'id_dosen_penguji2' => $request->id_dosen2,
                'group_id' => $group_id
            ]);
        }
        return redirect('jadwal-seminar')->with('success', ' Data Berhasil Diedit');
    }

    public function getAvailableDays($jumlah_ruangan)
    {
        return $this->getNextAllowedDateTime(0, 0, $jumlah_ruangan);
    }

    public function getAllowedDays($value, $today)
    {
        $allowedDays = ['Monday', 'Tuesday', 'Wednesday'];

        if ($value > 0) {
            $currentDay = Carbon::createFromDate($today)->addDays();
        } else {
            $currentDay = Carbon::now(new CarbonTimeZone('Asia/Jakarta'));
        }

        if (in_array($currentDay->format('l'), $allowedDays)) {
            return [
                'day' => $currentDay->format('l'),
                'date' => $currentDay->format('Y-m-d'),
            ];
        }

        $nextDay = $currentDay->copy();

        while (!in_array($nextDay->format('l'), $allowedDays)) {
            $nextDay->addDay();
        }

        return [
            'day' => $nextDay->format('l'),
            'date' => $nextDay->format('Y-m-d')
        ];
    }

    public function getAllowedTimes($value, $day): DateTime
    {
        if ($value > 0) {
            $today = Carbon::createFromDate($this->getAllowedDays(1, $day)['date'])->toDateString();
        } else {
            $today = Carbon::createFromDate($this->getAllowedDays(0, 0)['date'])->toDateString();
        }
        $count9AM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 09:00:00')
            ->where('tanggal', '<', $today . ' 09:40:00')
            ->count();

        $count940AM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 09:40:00')
            ->where('tanggal', '<', $today . ' 10:20:00')
            ->count();

        $count1020AM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 10:20:00')
            ->where('tanggal', '<', $today . ' 13:00:00')
            ->count();

        $count1PM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 13:00:00')
            ->where('tanggal', '<', $today . ' 13:40:00')
            ->count();

        $count1340PM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 13:40:00')
            ->where('tanggal', '<', $today . ' 14:20:00')
            ->count();

        $count1420PM = DB::table('penjadwalan_seminar')
            ->where('tanggal', '>=', $today . ' 14:20:00')
            ->where('tanggal', '<', $today . ' 23:59:59')
            ->count();

        $nextDay = null;
        $resultTime = null;

        if ($count9AM >= 0 && $count9AM < 2) {
            $resultTime = '09:00';
        } elseif ($count9AM >= 2 && $count940AM >= 0 && $count940AM < 2) {
            $resultTime = '09:40';
        } elseif ($count9AM >= 2 && $count940AM >= 2 && $count1020AM >= 0 && $count1020AM < 2) {
            $resultTime = '10:20';
        } elseif ($count9AM >= 2 && $count940AM >= 2 && $count1020AM >= 2 && $count1PM >= 0 && $count1PM < 2) {
            $resultTime = '13:00';
        } elseif ($count9AM >= 2 && $count940AM >= 2 && $count1020AM >= 2 && $count1PM >= 2 && $count1340PM >= 0 && $count1340PM < 2) {
            $resultTime = '13:40';
        } elseif ($count9AM >= 2 && $count940AM >= 2 && $count1020AM >= 2 && $count1PM >= 2 && $count1340PM >= 2 && $count1420PM >= 0 && $count1420PM < 2) {
            $resultTime = '14:20';
        } elseif ($count9AM >= 2 && $count940AM >= 2 && $count1020AM >= 2 && $count1PM >= 2 && $count1340PM >= 2 && $count1420PM >= 2) {
            return ($this->getAllowedTimes(1, $today));
        }

        if ($nextDay !== null) {
            return $nextDay;
        }

        return new DateTime($today . " " . $resultTime);
    }

    public function getNextAllowedDateTime($value, $day, $jumlah_ruangan)
    {
        if ($value > 0) {
            $today = Carbon::createFromDate($day)->addDays();
        } else {
            $today = Carbon::now(new CarbonTimeZone('Asia/Jakarta'))->addDays();
        }

        $dayMappings = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $seminarWaktu = DB::table('seminar_waktu')
            ->where('hari', $dayMappings[$today->format('l')])
            ->orderBy('hari', 'desc')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        while (true) {
            foreach ($seminarWaktu as $waktu) {
                $count = DB::table('penjadwalan_seminar')
                    ->where('tanggal', '>=', $today->toDateString() . ' ' . $waktu->waktu_mulai)
                    ->where('tanggal', '<', $today->toDateString() . ' ' . $waktu->waktu_selesai)
                    ->count();

                if ($count < $jumlah_ruangan) {
                    return [
                        "date" => new DateTime($today->toDateString() . ' ' . $waktu->waktu_mulai),
                        "time" => $this->getMinuteDifference($waktu->waktu_mulai, $waktu->waktu_selesai)
                    ];
                }
            }

            $nextDateTime = $this->getNextAllowedDateTime(1, $today, $jumlah_ruangan);
            if ($nextDateTime !== null) {
                return $nextDateTime;
            }
        }

        return [
            "date" =>  new DateTime($today->toDateString() . ' ' . $seminarWaktu[0]->waktu_mulai),
            "time" => $this->getMinuteDifference($waktu->waktu_mulai, $waktu->waktu_selesai)
        ];
    }

    function getMinuteDifference($time1, $time2)
    {
        $datetime1 = new DateTime($time1);
        $datetime2 = new DateTime($time2);
        $interval = $datetime1->diff($datetime2);
        $minutes = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;
        return $minutes;
    }
}
