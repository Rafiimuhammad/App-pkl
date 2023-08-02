<!DOCTYPE html>
<html lang="en">
@includeIf('layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @includeIf('layouts.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="{{ asset('Foto/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">S1 INFORMATIKA</span>
        </a>

        <!-- Sidebar -->
        @includeIf('layouts.sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="mb-5">
                <h1>Jadwal Seminar</h1>
            </div>
            <div class="container-fluid">
                <div class="row mb-2">
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="content">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5></h5>
                    </div>
                    <div class="card-body">
                        @if ($jadwalDosen == "No Data")
                            Jadwal Seminar Anda Belum Ada
                        @else
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Mahasiswa</th>
                                    <th>Ruangan</th>
                                    <th>Jadwal Seminar</th>
                                    <th>Durasi</th>
{{--                                    <th>Dosen Penguji 1</th>--}}
{{--                                    <th>Dosen Penguji 2</th>--}}
                                </tr>
                                @foreach ($jadwalDosen as $val)
                                    <tr>
                                        <td>{{ $val->pendaftaranseminarpkl->user->nama }}</td>
                                        <td>{{ $val->ruangan }}</td>
                                        <td>{{ $val->tanggal }}</td>
                                        <td>{{ $val->durasi }}</td>
{{--                                        <td>{{ \App\Models\Dosen::find($val->id_dosen_penguji1)->namadosen }}</td>--}}
{{--                                        <td>{{ \App\Models\Dosen::find($val->id_dosen_penguji2)->namadosen }}</td>--}}
                                    </tr>
                                @endforeach
                            </table>
                    @endif
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
    @includeIf('layouts.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@includeIf('layouts.script')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>
