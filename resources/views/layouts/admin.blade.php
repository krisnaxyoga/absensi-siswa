<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="/dashboard_assets/css/styles.css" rel="stylesheet" />
    <link href="/dashboard_assets/cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link rel="icon" type="image/x-icon" href="/images/logo.png" />
    <script data-search-pseudo-elements defer
        src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>

    @stack('style')
    <title>Dashboard</title>
</head>

<body>
    <nav class="topnav navbar navbar-expand shadow navbar-light bg-white" id="sidenavAccordion">
        <a class="navbar-brand h-100 text-truncate" href="#">
            Dashboard Admin
        </a>
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 mr-lg-2" id="sidebarToggle"
            href="#"><i data-feather="menu"></i></button>

        <ul class="navbar-nav align-items-center ml-auto">
            <li class="nav-item dropdown no-caret mr-2 dropdown-user">
                <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage"
                    href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em"
                        viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M487.4 315.7l-42.6-24.6c4.3-23.2 4.3-47 0-70.2l42.6-24.6c4.9-2.8 7.1-8.6 5.5-14-11.1-35.6-30-67.8-54.7-94.6-3.8-4.1-10-5.1-14.8-2.3L380.8 110c-17.9-15.4-38.5-27.3-60.8-35.1V25.8c0-5.6-3.9-10.5-9.4-11.7-36.7-8.2-74.3-7.8-109.2 0-5.5 1.2-9.4 6.1-9.4 11.7V75c-22.2 7.9-42.8 19.8-60.8 35.1L88.7 85.5c-4.9-2.8-11-1.9-14.8 2.3-24.7 26.7-43.6 58.9-54.7 94.6-1.7 5.4.6 11.2 5.5 14L67.3 221c-4.3 23.2-4.3 47 0 70.2l-42.6 24.6c-4.9 2.8-7.1 8.6-5.5 14 11.1 35.6 30 67.8 54.7 94.6 3.8 4.1 10 5.1 14.8 2.3l42.6-24.6c17.9 15.4 38.5 27.3 60.8 35.1v49.2c0 5.6 3.9 10.5 9.4 11.7 36.7 8.2 74.3 7.8 109.2 0 5.5-1.2 9.4-6.1 9.4-11.7v-49.2c22.2-7.9 42.8-19.8 60.8-35.1l42.6 24.6c4.9 2.8 11 1.9 14.8-2.3 24.7-26.7 43.6-58.9 54.7-94.6 1.5-5.5-.7-11.3-5.6-14.1zM256 336c-44.1 0-80-35.9-80-80s35.9-80 80-80 80 35.9 80 80-35.9 80-80 80z" />
                    </svg></a>
                <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage">
                    <h6 class="dropdown-header d-flex align-items-center">
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">{{ Auth::user()->name }}</div>
                            <div class="dropdown-user-details-email">{{ Auth::user()->email }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="GET" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sidenav shadow-right sidenav-light">
                <div class="sidenav-menu">
                    <div class="nav accordion" id="accordionSidenav">
                        <div class="sidenav-menu-heading">Main</div>
                        <a class="nav-link" href="/">
                            <div class="nav-link-icon"><i data-feather="activity"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{ route('petugas.index') }}">
                            <div class="nav-link-icon"><i data-feather="user"></i></div>
                            user
                        </a>
                        <a class="nav-link" href="{{ route('kelas.index') }}">
                            <div class="nav-link-icon"><i data-feather="archive"></i></div>
                            kelas
                        </a>
                        <a class="nav-link" href="{{ route('siswa.index') }}">
                            <div class="nav-link-icon"><i data-feather="users"></i></div>
                            siswa
                        </a>
                        <a class="nav-link" href="{{ route('absensi.index') }}">
                            <div class="nav-link-icon"><i data-feather="aperture"></i></div>
                            absensi
                        </a>
                        <a class="nav-link" href="{{ route('absensi.surat_ijin') }}">
                            <div class="nav-link-icon"><i data-feather="aperture"></i></div>
                            Surat Ijin
                        </a>
                        <a class="nav-link" href="{{ route('rekapabsensi.index') }}">
                            <div class="nav-link-icon"><i data-feather="file"></i></div>
                            rekap absensi
                        </a>
                        <a class="nav-link" href="{{ route('pengumuman.index') }}">
                            <div class="nav-link-icon"><i data-feather="message-square"></i></div>
                            Pengumuman
                        </a>
                    </div>
                </div>
                <div class="sidenav-footer">
                    <div class="sidenav-footer-content">
                        <div class="sidenav-footer-subtitle">Logged in as:</div>
                        <div class="sidenav-footer-title">{{ Auth::user()->name }}</div>
                    </div>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main class="mt-4">
                @yield('contents')
            </main>
            <footer class="footer mt-auto footer-light">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 small">Copyright &#xA9; {{ date('Y') }}</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="/dashboard_assets/code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="/dashboard_assets/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/dashboard_assets/cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" crossorigin="anonymous">
    </script>
    <script src="/dashboard_assets/assets/demo/chart-area-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-bar-demo.js"></script>
    <script src="/dashboard_assets/assets/demo/chart-pie-demo.js"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous">
    </script>
    <script src="/dashboard_assets/assets/demo/datatables-demo.js"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/momentjs/latest/moment.min.js" crossorigin="anonymous"></script>
    <script src="/dashboard_assets/cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js" crossorigin="anonymous">
    </script>
    <script src="/dashboard_assets/assets/demo/date-range-picker-demo.js"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
    @stack('script')

</body>

</html>
