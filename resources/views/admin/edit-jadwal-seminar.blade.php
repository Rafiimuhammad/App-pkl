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
                    <h1>Edit Jadwal Seminar</h1>
                </div>
                <div class="card-tools">
                    <a href="{{ url('jadwal-seminar') }}" class="btn btn-dark">Kembali</a>
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

                        <form action="{{ url('/update-jadwal-seminar/' . $data['penjadwalanseminar'][0]->group_id) }}"
                            method="POST" class="card-body row">
                            @csrf
                            <div class="col-sm-6">
                                <h5>Data Mahasiswa</h5>
                                <select name="mahasiswa[]" multiple class="form-control" style="height:200px">
                                    @foreach ($data['pendaftaranseminarpkl'] as $val)
                                        <option value="{{ $val->id }}">{{ $val->user->mahasiswa->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <h5>Dosen Penguji 1</h5>
                                <select name="id_dosen" class="form-control">
                                    @foreach ($data['dosen'] as $val)
                                        <option value="{{ $val->id }}">{{ $val->namadosen }}</option>
                                    @endforeach
                                </select><br>
                                <h5>Dosen Penguji 2</h5>
                                <select name="id_dosen2" class="form-control">
                                    @foreach ($data['dosen'] as $val)
                                        <option value="{{ $val->id }}">{{ $val->namadosen }}</option>
                                    @endforeach
                                </select>
                                <h5>Ruangan</h5>
                                <input name="ruangan" type="text" class="form-control"
                                    value="{{ $data['penjadwalanseminar'][0]->ruangan }}"
                                    placeholder="Masukkan Ruangan"><br>
                                <h5>Jadwal</h5>
                                <input name="tanggal" type="datetime-local" class="form-control"
                                    value="{{ $data['penjadwalanseminar'][0]->tanggal }}"
                                    placeholder="Masukkan Jadwal"><br>
                                <h5>Durasi</h5>
                                <input name="durasi" type="text" class="form-control"
                                    value="{{ $data['penjadwalanseminar'][0]->durasi }}"
                                    placeholder="Masukkan Durasi"><br><br>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-warning">Edit</button>
                                </div>
                            </div>
                        </form>
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
