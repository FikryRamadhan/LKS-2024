<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ auth()->user()->type_user }} | Food XYZ</title>
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/atlantis.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">
    <link rel="stylesheet" href="{{ url('css/custom/select2-atlantis.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ url('vendors/ladda/ladda-themeless.min.css') }}">
    <link rel="stylesheet" href="{{ url('vendors/jquery-confirm/jquery-confirm.css') }}">

    <link rel="stylesheet" href="{{ url('vendors/select2/select2.css') }}">
    <link rel="stylesheet" href="{{ url('css/custom/select2-atlantis.css') }}">
    <link href="{{ url('img/favicon.png') }}" rel="icon" type="image/png">
    <style type="text/css">
        .btn-rounded {
            border: 1px;
            border-radius: 20px;
        }

        .bg-primary {
            background-color: #58a4c7 !important;
            width: 100%;
            height: 100%;
        }

        .bg-sidebar {
            background-color: #b3d9eb !important;
            width: 25%;
        }

        .text-bold {
            font-weight: bold;
            color: black;
        }

        .icon-sidebar {
            width: 100%;
            margin-bottom: 20px;
            margin-top: px;
            text-align: center;
            display: block;
            object-fit: contain
        }

        .btn {
            border: 1px;
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #529ec2 !important;
        }

        .btn-primary:hover {
            background-color: #69c3ec !important;
        }

        .role {
            margin-top: 20px;
            font-size: 40px;
            color: black;
        }

        .head {
            text-align: center;
            color: black;
            font-weight: bold;
            font-size: 30px;
        }

        .logout {
            margin-top: 70px;
            margin-bottom: 0px;
        }

        a:hover {
            text-decoration: none;
            color: black;
        }
    </style>

    <script src="{{ url('js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                    "simple-line-icons"
                ],
                urls: [`{{ url('css/fonts.min.css') }}`]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar full-height bg-sidebar">
            <div class="sidebar-wrapper">
                <div class="sidebar-content">
                    @include('layouts.menu')
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel full-height">
            <div class="content">
                @yield('content')
            </div>
        </div>

        <!-- LIBARARY JS -->
        <script type="text/javascript" language="javascript" src="{{ asset('vendors/jquery/jquery-3.4.1.js') }}"></script>
        {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}


        <!--   Core JS Files   -->

        {{-- ON ERRORR PAGE TRANSACTIONS --}}
        <script src="{{ url('js/core/popper.min.js') }}"></script>
        <script src="{{ url('js/core/bootstrap.min.js') }}"></script>

        <!-- jQuery UI -->
        <script src="{{ url('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
        <script src="{{ url('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>

        <!-- jQuery Scrollbar -->
        <script src="{{ url('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>


        <!-- Chart JS -->

        <!-- jQuery Sparkline -->
        <script src="{{ url('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

        <!-- Chart Circle -->

        <!-- Datatables -->
        <script src="{{ url('js/plugin/datatables/datatables.min.js') }}"></script>

        <!-- Bootstrap Notify -->
        <script src="{{ url('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

        <!-- jQuery Vector Maps -->

        <!-- Sweet Alert -->
        <script src="{{ url('js/plugin/sweetalert/sweetalert.min.js') }}"></script>

        <!-- Atlantis JS komen -->
        <script src="{{ url('js/atlantis.min.js') }}"></script>


        <script src="{{ url('vendors/ladda/spin.min.js') }}"></script>
        <script src="{{ url('vendors/ladda/ladda.min.js') }}"></script>
        <script src="{{ url('vendors/ladda/ladda.jquery.min.js') }}"></script>
        <script src="{{ url('vendors/jquery-confirm/jquery-confirm.js') }}"></script>
        <script src="{{ url('vendors/select2/select2.min.js') }}"></script>
        <script src="{{ url('vendors/chartjs/chart.js') }}"></script>
        <script src="{{ url('js/myJs.js') }}"></script>
        @yield('scripts')

</body>

</html>
