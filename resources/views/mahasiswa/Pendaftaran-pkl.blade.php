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
                <img src="{{asset('Foto/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
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
                    <h1>Pengajuan Pendaftaran PKL</h1>
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
                                    <form action="/inputdatapendaftaranpkl" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <h5>Status :
                                            @if(!$data)
                                            @elseif($data->status == "1")
                                            Belum Mengajukan
                                            @elseif($data->status == "2")
                                            Belum Dikonfirmasi
                                            @elseif($data->status == "3")
                                            Diterima
                                            @elseif($data->status == "4")
                                            Ditolak
                                            @elseif($data->status == "5")
                                            Dosen Sudah Ditentukan
                                            @endif
                                        </h5>
                                        @if($data->status != "1")
                                        <a target="_blank" href="{{ url('/viewpendaftaranpkl',$data->id) }}"
                                            class="mt-3 btn btn-primary">Lihat File</a>
                                        @endif
                                        @if($data->id_dosen != null)
                                        <br>
                                        <br>
                                        <h5>Dosen Pembimbing : {{$data->dosen->namadosen}}</h5>
                                        @endif
                                        <hr>
                                        <div class="form-group mb-0">
                                            <label for="exampleInputEmail1" class="form-label">Judul PKL</label>
                                            <input type="text" name="judulpkl" class="form-control"
                                                value="{{ $data->judulpkl }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="exampleInputEmail1" class="form-label">File Persyaratan Daftar
                                                PKL</label>
                                            <input type="file" name="filepersyaratanpkl" class="form-control">
                                            <div id="filehelp" class="form-text">*KHS Semester 1 s.d 5.</div
                                            <div id="filehelp" class="form-text">*Lampiran Lembar Surat Pernyataan Diterima Magang.</div>
                                            <div id="filehelp" class="form-text">*Persyaratan dapat dilihat pada Lampiran pedoman PKL.</div>
                                            <div id="filehelp" class="form-text">*File diupload dengan format PDF dan digabungkan jadi satu.</div>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    @if($data->status == "1" || $data->status == "2" || $data->status == "4")
                                    <button type="submit" class="btn btn-dark">Upload Data</button>
                                    @endif
                                </div>
                                </form>
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