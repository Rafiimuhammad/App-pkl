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
                    <h1>Laporan Mahasiswa</h1>
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
                            <table class="table table-bordered">

                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>Dosen Pembimbing 1</th>
                                    <th>Dosen Pembimbing 2</th>
                                    <th>Judul PKl</th>
                                    <th>Minggu</th>
                                    <th>Tanggal Diupload</th>
                                    <th>Status Dosen 1</th>
                                    <th>Status Dosen 2</th>
                                    <th>Aksi</th>
                                </tr>
                                @php
                                $no = 1;
                                @endphp
                                @foreach ($data as $row)
                                    <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$row->pendaftaranpkl->user->mahasiswa->nim}}</td>
                                    <td>{{$row->pendaftaranpkl->user->mahasiswa->nama}}</td>
                                    <td>{{$row->pendaftaranpkl->dosen1 ? $row->pendaftaranpkl->dosen1->namadosen : ""}}</td>
                                    <td>{{$row->pendaftaranpkl->dosen2 ? $row->pendaftaranpkl->dosen2->namadosen : ""}}</td>
                                    <td>{{$row->pendaftaranpkl->judulpkl}}</td>
                                    <td>{{$row->minggu}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td class="project-state">
                                        @if($row->status==1) <span class="badge badge-success">Diterima</span>
                                        @elseif($row->status==2) <span class="badge badge-danger">Ditolak</span>
                                        @else <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td class="project-state">
                                        @if($row->status1==1) <span class="badge badge-success">Diterima</span>
                                        @elseif($row->status1==2) <span class="badge badge-danger">Ditolak</span>
                                        @else <span class="badge badge-warning">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ url('/viewlogbook',$row->id) }}"
                                            target="_blank" rel="noopener noreferer">
                                            <i class="fas fa-folder">
                                            </i>
                                        </a>
                                        <a class="btn btn-danger btn-sm delete" data-id="{{ $row->id }}"
                                            data-nama="{{ $row->nama }}">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                        @if($row->pendaftaranpkl->dosen1->id == auth()->user()->dosen->id && $row->status==0)
                                            <hr class="m-1">
                                            <a class="btn btn-success btn-sm" href="/ubah-status-logbook/{{ $row->id }}/terima/dosen1">Terima</a>
                                            <a class="btn btn-danger btn-sm" href="/ubah-status-logbook/{{ $row->id }}/tolak/dosen1">Tolak</a>
                                        @elseif($row->pendaftaranpkl->dosen2->id == auth()->user()->dosen->id && $row->status1==0)
                                            <hr class="m-1">
                                            <a class="btn btn-success btn-sm" href="/ubah-status-logbook/{{ $row->id }}/terima/dosen2">Terima</a>
                                            <a class="btn btn-danger btn-sm" href="/ubah-status-logbook/{{ $row->id }}/tolak/dosen2">Tolak</a>
                                        @endif
{{--                                        @if ($row->status==0)--}}
{{--                                            <hr class="m-1">--}}
{{--                                            <a class="btn btn-success btn-sm" href="/ubah-status-logbook/{{ $row->id }}/terima">Terima</a>--}}
{{--                                            <a class="btn btn-danger btn-sm" href="/ubah-status-logbook/{{ $row->id }}/tolak">Tolak</a>--}}
{{--                                        @endif--}}
                                    </td>
                                </tr>
                                @endforeach
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
<script>
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
</script>

</html>
