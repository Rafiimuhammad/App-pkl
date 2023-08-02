<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd; /* Add a border to the table */
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            border-right: 1px solid #ddd; /* Add a border to the right of header cells */
        }

        td {
            border-right: 1px solid #ddd; /* Add a border to the right of regular cells */
        }

        tr:last-child td {
            border-bottom: none; /* Remove the bottom border from the last row */
        }
    </style>
</head>
<body>
<h2>{{ $title }}</h2>

<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama Mahasiswa</th>
        <th>Ruangan</th>
        <th>Jadwal Seminar</th>
        <th>Durasi</th>
        <th>Dosen Penguji 1</th>
        <th>Dosen Penguji 2</th>
    </tr>
    </thead>
    <tbody>
    @foreach($jadwalSeminar as $js)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $js->pendaftaranseminarpkl->user->nama}}</td>
            <td>{{ $js->ruangan }}</td>
            <td>{{ $js->tanggal }}</td>
            <td>{{ $js->durasi }}</td>
            <td>{{\App\Models\Dosen::find($js['id_dosen_penguji1'])->namadosen}}</td>
            <td>{{\App\Models\Dosen::find($js['id_dosen_penguji2'])->namadosen}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
