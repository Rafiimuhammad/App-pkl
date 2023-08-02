<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
            <img src="{{ asset('AdminLTE/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
        alt="User Image">
    </div> --}}
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (auth()->user()->level == 'Koordinator')
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class=" fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class=" fas fa-chart-pie"></i>
                        <p>Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/datauser" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <i class=" fas fa-user"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datadosen" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Data Dosen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/datamahasiswa" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Data Mahasiswa</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('penentuan-dosen') }}" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <p>Pendaftaran PKL</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('panduan-master') }}" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <p>Panduan Master</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('ruangan-waktu') }}" class="nav-link">
                        <i class="fa-solid fa-user"></i>
                        <p>Ruangan & Waktu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('jadwal-seminar') }}" class="nav-link">
                        <i class="fa-solid fa-calendar-days"></i>
                        <p>Jadwal Seminar</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
            <a href="/datapendaftaranpkl" class="nav-link">
                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                <p>Data Pendaftaran PKL</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/datalogbook" class="nav-link">
                <i class="fa-solid fa-book"></i>
                <p>Data Logbook</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="/datapendaftaranseminar" class="nav-link">
                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                <p>Data Pendaftaran Seminar PKL</p>
            </a>
        </li> -->
            @endif
            @if (auth()->user()->level == 'Dospem')
                <li class="nav-header">Dosen Pembimbing</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class=" fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/laporan-mahasiswa" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>LogBooks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pengajuan-seminar" class="nav-link">
                                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                                <p>Pengajuan Seminar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('jadwal-seminar') }}" class="nav-link">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Jadwal Seminar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif

            @if (auth()->user()->level == 'Mahasiswa')
                <li class="nav-item menu-open">
                    <a href="/" class="nav-link">
                        <i class=" fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('panduan-penggunaan') }}" class="nav-link">
                                <i class="fa-solid fa-file"></i>
                                <p>Panduan PKL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pendaftaranpkl" class="nav-link">
                                <i class="fa-solid fa-users"></i>
                                <p>Pendaftaran PKL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/logbook" class="nav-link">
                                <i class="fa-sharp fa-solid fa-clipboard-list"></i>
                                <p>LogBooks</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/pendaftaranseminarpkl" class="nav-link">
                                <i class="fa-solid fa-book"></i>
                                <p>Pendaftaran Seminar PKL</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('jadwal-seminar') }}" class="nav-link">
                                <i class="fa-solid fa-calendar-check"></i>
                                <p>Jadwal Seminar</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            <li class="card bg-danger">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <p>Keluar</p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
