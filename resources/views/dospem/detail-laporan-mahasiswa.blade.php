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
                <div class="mb-5">
                    <h1>Detail Laporan Mahasiswa</h1>
                </div>
                <div class="card-tools">
                    <a href="{{ url('laporan-mahasiswa') }}" class="btn btn-dark">Kembali</a>
                    {{-- <a href="/tambahdatapendaftaranpkl" class="btn btn-success">Tambah Data +</a> --}}
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
                            <h5>Nama : Dian</h5>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr>
                                    <th>No</th>
                                    <td>Nama Laporan</td>
                                    <td>File</td>
                                    <td>Status</td>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Laporan</td>
                                    <td><a href="">Lihat File</a></td>
                                    <td>Diterima</td>
                                    <td>
                                        <a href="{{ url('detail-laporan-mahasiswa') }}" class="btn btn-danger">Tolak</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Logbook</td>
                                    <td><a href="">Lihat File</a></td>
                                    <td>Ditolak</td>
                                    <td>
                                        <a href="{{ url('detail-laporan-mahasiswa') }}" class="btn btn-info">Terima</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Project</td>
                                    <td><a href="">Lihat File</a></td>
                                    <td>Diterima</td>
                                    <td>
                                        <a href="{{ url('detail-laporan-mahasiswa') }}" class="btn btn-danger">Tolak</a>
                                    </td>
                                </tr>
                                
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
{{-- <script>
    $('.delete').click(function () {
        var datapendaftaranpklid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
                title: "Apa kamu yakin?",
                text: "Kamu akan menghapus data pendaftaran pkl nama " + nama + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletedatapendaftaranpkl/" + datapendaftaranpklid + ""
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                } else {
                    swal("Data tidak jadi dihapus");
                }
            });
    });
</script> --}}

</html>