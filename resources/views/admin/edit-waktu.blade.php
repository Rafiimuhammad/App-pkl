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
                    <h1>Tambah Waktu</h1>
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
                                <form action="/edit-waktu/{{ $waktu->id }}" method="POST"
                                    enctype="multipart/form-data" id="formTambahWaktu">
                                    @method('put')
                                    {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="form-label">Hari</label>
                                            <select name="hari" class="form-control">
                                                <option value="Senin"
                                                    @if ($waktu->hari === 'Senin') selected @endif>Senin</option>
                                                <option value="Selasa"
                                                    @if ($waktu->hari === 'Selasa') selected @endif>Selasa</option>
                                                <option value="Rabu"
                                                    @if ($waktu->hari === 'Rabu') selected @endif>Rabu</option>
                                                <option value="Kamis"
                                                    @if ($waktu->hari === 'Kamis') selected @endif>Kamis</option>
                                                <option value="Jumat"
                                                    @if ($waktu->hari === 'Jumat') selected @endif>Jumat</option>
                                                <option value="Sabtu"
                                                    @if ($waktu->hari === 'Sabtu') selected @endif>Sabtu</option>
                                                <option value="Minggu"
                                                    @if ($waktu->hari === 'Minggu') selected @endif>Minggu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="">Waktu Mulai</label>
                                                    <input type="time" name="waktu_mulai" class="form-control"
                                                        placeholder="Mulai (Contoh: 10:00)"
                                                        value="{{ $waktu->waktu_mulai ? date('H:i', strtotime($waktu->waktu_mulai)) : '' }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">Waktu Selesai</label>
                                                    <input type="time" name="waktu_selesai" class="form-control"
                                                        placeholder="Selesai (Contoh: 11:00)"
                                                        value="{{ $waktu->waktu_selesai ? date('H:i', strtotime($waktu->waktu_selesai)) : '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
