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
                    <h1>Pendaftaran PKL</h1>
                </div>
                <div class="card-tools">
                    <!-- <a class="btn btn-success" href="/tambahdatapendaftaranpkl">
                        <i class="fa-solid fa-circle-plus"></i>
                        Tambah
                    </a> -->
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
                            <h5> </h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Dosen Pembimbing 2</th>
                                    <th>Tanggal Mendaftar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($data as $index => $row)
                                    <tr>
                                        <td>{{$index + $data->firstItem()}}</td>
                                        <td>{{ $row->user->mahasiswa->nim }}</td>
                                        <td>{{ $row->user->mahasiswa->nama }}</td>
                                        <td>{{ $row->dosen1 ? $row->dosen1->namadosen : '' }}</td>
                                        <td>{{ $row->dosen2 ? $row->dosen2->namadosen : '' }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            @if ($row->filepersyaratanpkl == '1')
                                                <div class="badge badge-dark">Belum Mengajukan</div>
                                            @elseif($row->status == '2')
                                                <div class="badge badge-warning">Belum Dikonfirmasi</div>
                                            @elseif($row->status == '3')
                                                <div class="badge badge-success">Disetujui</div>
                                            @elseif($row->status == '4')
                                                <div class="badge badge-danger">Ditolak</div>
                                            @elseif($row->status == '5')
                                                <div class="badge badge-info">Dosen Sudah Ditentukan</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->status == '3')
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ url('penentuan-dosen-edit/' . $row->id) }}">
                                                    Tentukan Dospem
                                                </a>
                                                <hr>
                                            @endif
                                            @if ($row->status >= '2')
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ url('/viewpendaftaranpkl', $row->id) }}" target="_blank"
                                                    rel="noopener noreferer">
                                                    <i class="fas fa-folder">
                                                    </i>
                                                </a>
                                            @endif
                                            @if ($row->status == '2')
                                                <a onclick="return confirm('Apakah Anda Yakin, Mengubah Status Menjadi Disetujui?')"
                                                    class="btn btn-info btn-sm"
                                                    href="{{ url('ubah-status-pengajuan-pkl/' . $row->id) }}/setuju">Setujui</a>
                                                <a onclick="return confirm('Apakah Anda Yakin, Mengubah Status Menjadi Ditolak?')"
                                                    class="btn btn-danger btn-sm"
                                                    href="{{ url('ubah-status-pengajuan-pkl/' . $row->id) }}/tolak">Tolak</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="card-footer">
                            {{ $data->links() }}
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
        var datalogbookid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
                title: "Apa kamu yakin?",
                text: "Kamu akan menghapus data logbook nama " + nama + " ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/deletedatalogbook/" + datalogbookid + ""
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
