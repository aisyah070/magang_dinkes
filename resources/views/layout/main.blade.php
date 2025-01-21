<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminKKG | {{ $title }}</title>

    <!--=============== ICON WEB ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/icons/logo_dinkes.ico') }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="nav-link"
                            style="background: none; border: none; color: inherit; cursor: pointer;">
                            <i class="fas fa-right-from-bracket"></i> Log Out
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link">
                <img class="mr-3 ml-2" src="{{ asset('assets/icons/logo_dinkes.png') }}" height="55" width="40"
                    alt="">
                <span class="brand-text font-weight-light">Seksi KKG</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        <li class="nav-header">DASHBOARD</li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="nav-link">
                                <i class="fa-solid fa-gauge-high fa-lg"></i>
                                <p> Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-header">DOKUMENTASI</li>
                        <li class="nav-item">
                            <a href="{{ route('modul') }}" class="nav-link">
                                <i class="fa-solid fa-file fa-lg"></i>
                                <p> Modul</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('video') }}" class="nav-link">
                                <i class="fa-solid fa-video fa-lg"></i>
                                <p> Video</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('foto') }}" class="nav-link">
                                <i class="fa-solid fa-image fa-lg"></i>
                                <p> Foto</p>
                            </a>
                        </li>

                        <li class="nav-header">PROFIL</li>
                        <li class="nav-item">
                            <a href="{{ route('profil-staff.index') }}" class="nav-link">
                                <i class="fa-solid fa-user fa-lg"></i>
                                <p> Profil Pegawai</p>
                            </a>
                        </li>

                        <li class="nav-header">AKUN</li>
                        <li class="nav-item">
                            <a href="{{ route('user') }}" class="nav-link">
                                <i class="fa-solid fa-users fa-lg"></i>
                                <p> Akun Pegawai</p>
                            </a>
                        </li>

                        <li class="nav-header">KATEGORI</li>
                        <li class="nav-item">
                            <a href="{{ route('kategori_foto.index') }}" class="nav-link">
                                <i class="fa-solid fa-list fa-lg"></i>
                                <p> Kategori Foto</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>&copy; 2025 <a href="#">AdminSeksiKKG</a>.</strong> All rights reserved.
        </footer>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Admin LTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
