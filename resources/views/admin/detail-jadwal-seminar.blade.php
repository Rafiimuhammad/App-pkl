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
                    <h1>Detail Jadwal Seminar</h1>
                </div>
                <div class="card-tools">
                    <a href="{{url('jadwal-seminar')}}" class="btn btn-dark">Kembali</a>
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

                        <div class="card-body row">
                            <div class="col-sm-6">
                                <h5>Jumlah Mahasiswa</h5>
                                <p>{{count($data['penjadwalanseminar'])}}</p>
                                <h5>Data Mahasiswa</h5>
                                <table class="table table-responsive" style="height:200px">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Judul</th>
                                        <th>Dosen Pembimbing 1</th>
                                        <th>Dosen Pembimbing 2</th>
                                    </tr>
                                    @foreach($data['penjadwalanseminar'] as $index => $val)
                                    <tr>
                                        <td>{{ $index+1 }}</td>
                                        <td>{{ $val->pendaftaranseminarpkl->user->mahasiswa->nama }}</td>
                                        <td>{{ $val->pendaftaranseminarpkl->judulpkl }}</td>
                                        <td>{{ $val->pendaftaranseminarpkl->dosen1->namadosen }}</td>
                                        <td>{{ $val->pendaftaranseminarpkl->dosen2->namadosen }}</td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <h5>Dosen Penguji 1</h5>
                                <p>{{$data['penjadwalanseminar'][0]->dosen_penguji1 ? $data['penjadwalanseminar'][0]->dosen_penguji1->namadosen : '-'}}</p>
                                <h5>Dosen Penguji 2</h5>
                                <p>{{$data['penjadwalanseminar'][0]->dosen_penguji2 ? $data['penjadwalanseminar'][0]->dosen_penguji2->namadosen : '-'}}</p>
                                <h5>Ruangan</h5>
                                <p>{{$data['penjadwalanseminar'][0]->ruangan}}</p>
                                <h5>Jadwal</h5>
                                <p>{{$data['penjadwalanseminar'][0]->tanggal}}</p>
                                <h5>Durasi</h5>
                                <p>{{$data['penjadwalanseminar'][0]->durasi}}</p>
                                <a href="{{ url('edit-jadwal-seminar/'.$data['penjadwalanseminar'][0]->group_id) }}" class="btn btn-success">Edit Data Jadwal</a>        
                            </div>
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