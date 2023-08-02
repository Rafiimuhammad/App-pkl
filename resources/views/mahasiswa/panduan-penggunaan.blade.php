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
                    <h1>Panduan PKL</h1>
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
                            <h5>Form Bimbingan</h5>
                        </div>
                        <div class="card-body">
                            @if ($bimbingan == null)
                                Belum ada form bimbingan baru
                            @else
                                @if ($bimbingan->file)
                                    <iframe src="{{ asset('storage/' . $bimbingan->file) }}" width="100%"
                                        height="500px"></iframe>
                                @else
                                    File form bimbingan belum diunggah.
                                @endif
                            @endif
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5>Pedoman</h5>
                        </div>
                        <div class="card-body">
                            @if ($pedoman == null)
                                Belum ada pedoman baru
                            @else
                                @if ($pedoman->file)
                                    <iframe src="{{ asset('storage/' . $pedoman->file) }}" width="100%"
                                        height="500px"></iframe>
                                @else
                                    File pedoman belum diunggah.
                                @endif
                            @endif
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </section>
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
