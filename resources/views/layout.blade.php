<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> PARPS - @yield('title')</title>
    {{-- ==================================== CSS/JS ===================================== --}}

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">

    {{-- CSS ESPECIFICO --}}
    @yield('css')
    {{-- CSS ESPECIFICO --}}

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @yield('script')

    {{-- ====================================/ CSS/JS ===================================== --}}

</head>

<body class=" @if (session('theme') == 1) dark-mode @endif hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('img/logo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('img/logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">PARPS</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Alexander Pierce</a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item ">
                            <a href="{{ route('home') }}" class="nav-link @yield('home')">
                                <i class="nav-icon fas fa-home"></i>
                                <p>
                                    Início
                                </p>
                            </a>
                        </li>

                        <li class="nav-item @yield('register_open')">
                            <a href="#" class="nav-link @yield('register')">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    Cadastrar
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{ route('enterprise') }}" class="nav-link @yield('enterprise')">
                                        <i class="fa fa-building nav-icon"></i>
                                        <p>Empresa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('visitors') }}" class="nav-link @yield('visitors')">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>Visitantes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('destiny') }}" class="nav-link @yield('destiny')">
                                        <i class="fa fa-map-marker-alt nav-icon"></i>
                                        <p>Destinos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reason') }}" class="nav-link @yield('reason')">
                                        <i class="fa fa-list-ul nav-icon"></i>
                                        <p>Motivos</p>
                                    </a>
                                </li>



                            </ul>
                        </li>
                        <li class="nav-item @yield('reports_open')">
                            <a href="#" class="nav-link @yield('reports')">
                                <i class="nav-icon fas fa-clipboard-list"></i>
                                <p>
                                    Relatorios
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item ">
                                    <a href="{{ route('reports_enterprise') }}"
                                        class="nav-link @yield('reports_enterprise')">
                                        <i class="fa fa-building nav-icon"></i>
                                        <p>Por empresa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reports_visitors') }}"
                                        class="nav-link @yield('reports_visitors')">
                                        <i class="fa fa-users nav-icon"></i>
                                        <p>Por visitantes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('reports_date') }}" class="nav-link @yield('reports_date')">
                                        <i class="fa fa-calendar nav-icon"></i>
                                        <p>Por data</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        @yield('content')

        <footer class="main-footer align-items-center ">
            <footer>
                <div class="text-center">
                    &copy;PARPS {{ date('Y') }} (v1.0) &copy;SisTAO {{ date('Y') }} (v1.0) <br>
                    Desenvolvido por: Eduardo Martins
                </div>
            </footer>
        </footer>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>
    {{-- ========================== MODAL ========================== --}}
    @yield('modal')
    {{-- ==================================== PLUGINS ===================================== --}}


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/locales.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.j') }}s"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('js/adminlte.js') }}"></script>
    @yield('plugins')
    {{-- ====================================/ PLUGINS ===================================== --}}
</body>


</html>
