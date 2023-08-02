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
                    <h1>Edit Persyaratan Seminar PKL</h1>
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
                                    <form action="/updatedatapendaftaranseminar/{{ $data->id }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nim</label>
                                            <input type="number" name="nim" class="form-control" id="exampleInputEmail1"
                                                placeholder="1855XXXX" value="{{ $data->nim }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="form-label">Nama</label>
                                            <input type="text" name="nama" class="form-control" id="exampleInputEmail1"
                                                placeholder="Masukkan Nama" value="{{ $data->nama }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukkan Email" value="{{ $data->email }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="exampleInputEmail1" class="form-label">Judul PKL</label>
                                            <input type="text" name="judulpkl" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Nama Judul" value="{{ $data->judulpkl }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label for="exampleInputEmail1" class="form-label">Dosen Pembimbing</label>
                                            <input type="text" name="dosenpembimbing" class="form-control"
                                                id="exampleInputEmail1" aria-describedby="emailHelp"
                                                placeholder="Masukkan Nama" value="{{ $data->dosenpembimbing }}">
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="exampleInputEmail1" class="form-label">File Logbook</label>
                                            <input type="file" name="filelogbook" class="form-control">
                                            <div id="filehelp" class="form-text">*File diupload dengan format PDF dan
                                                digabungkan jadi satu file.</div>
                                        </div>
                                        <div class="form-group mb-5">
                                            <iframe height="500" width="500" src="/filelogbookseminar/{{$data->filelogbook}}"></iframe>
                                            <div id="filehelp" class="form-text">*File sebelum diedit.</div>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="exampleInputEmail1" class="form-label">File Proposal</label>
                                            <input type="file" name="fileproposal" class="form-control">
                                            <div id="filehelp" class="form-text">*File diupload dengan format PDF dan
                                                digabungkan jadi satu file.</div>
                                        </div>
                                        <div class="form-group mb-0">
                                            <iframe height="500" width="500" src="/fileproposal/{{$data->fileproposal}}"></iframe>
                                            <div id="filehelp" class="form-text">*File sebelum diedit.</div>
                                        </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary float-right" onclick="window.history.back();">Batal</button>
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