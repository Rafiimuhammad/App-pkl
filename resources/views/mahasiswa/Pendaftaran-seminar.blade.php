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
            <div class="mb-3">
                <h1>Input Persyaratan Seminar PKL</h1>
            </div>
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <div class="card-body">
                                <form action="/inputdatapendaftaranseminar" method="POST"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}<h5>Status :
                                        @if (!$data)
                                        @elseif($data->status == '1')
                                            Belum Mengajukan
                                        @elseif($data->status == '2')
                                            Belum Dikonfirmasi
                                        @elseif($data->status == '3')
                                            Diterima
                                        @elseif($data->status == '4')
                                            Ditolak
                                        @endif
                                    </h5>
                                    @if (!is_null($data) && isset($data->status))
                                        @if ($data->status != '1')
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ url('/viewlogbookseminar', $data->id) }}" target="_blank"
                                               rel="noopener noreferrer">
                                                Lihat File Seminar
                                            </a>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ url('/viewproposal', $data->id) }}" target="_blank"
                                               rel="noopener noreferrer">
                                                Lihat File Proposal
                                            </a>
                                            <a class="btn btn-primary btn-sm"
                                               href="{{ route('view-bimbingan', $data->id) }}" target="_blank"
                                               rel="noopener noreferrer">
                                                Lihat File Bimbingan
                                            </a>

                                            <input name="id_user" value="{{$data->id_user}}" hidden>
                                        @else
                                            nothing
                                        @endif
                                        <hr>
                                        <div class="form-group mb-2">
                                            <label for="exampleInputEmail1" class="form-label">Judul PKL</label>
                                            <input readonly type="text" name="judulpkl" class="form-control"
                                                   id="exampleInputEmail1" aria-describedby="emailHelp"
                                                   placeholder="Nama Judul" value="{{ $data->judulpkl }}">
                                        </div>
                                    @else
                                        Data Pendaftaran Seminar Belum Ada
                                    @endif
                                    @if ($data->id_dosen != null)
                                        <br>
                                        <br>
                                        <h5>Dosen Pembimbing : {{ $data->dosen->namadosen }}</h5>
                                    @endif

                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1" class="form-label">File Logbook</label>
                                        <input type="file" name="filelogbook" class="form-control">
                                        <div id="filehelp" class="form-text">*File diupload dengan format PDF dan
                                            digabungkan jadi satu file.
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1" class="form-label">File Proposal</label>
                                        <input type="file" name="fileproposal" class="form-control">
                                        <div id="filehelp" class="form-text">*File diupload dengan format PDF dan
                                            digabungkan jadi satu file.
                                        </div>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="filebimbingan" class="form-label">Form Bimbingan</label>
                                        <input type="file" name="filebimbingan" class="form-control">
                                        <div id="filehelp" class="form-text">*File diupload dengan format PDF dan
                                            digabungkan jadi satu file.
                                        </div>
                                    </div>
                                    <div>
                                        @if ($data->status == '1' || $data->status == '2' || $data->status == '4')
                                            <button type="submit" class="btn btn-dark">Upload Data</button>
                                        @endif
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
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
</body>

</html>
