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
                    <h1>Data Ruangan & Waktu Master</h1>
                </div>
                <div class="mb-2">
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
                            <h5>Data Ruangan</h5>
                            <a class="btn btn-sm btn-primary" href="/tambah-ruangan">Tambah Data</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama Ruangan</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    @if ($ruangan->isEmpty())
                                        <td colspan="2">
                                            Data belum ada
                                        </td>
                                    @else
                                        @foreach ($ruangan as $data)
                                <tr>
                                    <td>
                                        {{ $data->nama_ruangan }}
                                    </td>
                                    <td>
                                        <a href="/edit-ruangan/{{ $data->id }}" class="btn btn-primary">Edit
                                            Ruangan</a>

                                        <form action="/delete-ruangan/{{ $data->id }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                </tr>
                            </table>
                        </div>
                        <div class="card-footer">
                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->

                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5>Data Waktu</h5>
                            <a class="btn btn-sm btn-primary" href="/tambah-waktu">Tambah Data</a>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">

                                <tr>
                                    <th>Hari</th>
                                    <th>Waktu</th>
                                    <th>Aksi</th>
                                </tr>
                                <tr>
                                    @if ($waktu->isEmpty())
                                        <td colspan="3">
                                            Data belum ada
                                        </td>
                                    @else
                                        @foreach ($waktu as $data)
                                <tr>
                                    <td>
                                        {{ $data->hari }}
                                    </td>
                                    <td>
                                        {{ $data->waktu_mulai }} - {{ $data->waktu_selesai }}
                                    </td>
                                    <td>
                                        <a href="/edit-waktu/{{ $data->id }}" class="btn btn-primary">Edit
                                            Waktu</a>

                                        <form action="/delete-waktu/{{ $data->id }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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

</html>
