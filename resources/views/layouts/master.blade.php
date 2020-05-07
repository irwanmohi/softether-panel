<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>{{ panel_name() }} - @yield('title') </title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="/assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="/assets/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="/assets/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="/assets/plugins/morrisjs/morris.css" rel="stylesheet" />

    <link href="/assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/themes/all-themes.css" rel="stylesheet" />

    <link href="/assets/plugins/dropzone/dropzone.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/custom.css" type="text/css" media="screen" title="no title" charset="utf-8">

    <style type="text/css" media="screen">
        .modal-loader {
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            color: #fff;
            text-align: center;
        }

        .swal-button--confirm {
            background-color: #3e236e;
        }

        .swal-button:not([disabled]):hover {
            background-color: rgba(62,35,110, .7);
        }

        .swal-content__input:focus, .swal-content__textarea:focus {
            outline: none;
            border-color: #3e236e;
        }
    </style>

    @livewireStyles

    <script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js" integrity="sha256-iM4Yzi/zLj/IshPWMC1IluRxTtRjMqjPGd97TZ9yYpU=" crossorigin="anonymous"></script>

    <script charset="utf-8">
        Turbolinks.start();
    </script>

    @yield('css')
</head>

<body class="theme-deep-purple">

    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index.html">{{ panel_name() }}</a>
            </div>
        </div>
    </nav>

    <!-- #Top Bar -->
    @include('layouts.sidebar-master')

    <section class="content">
        <div class="container-fluid">

            <div class="block-header">
                <h2>@yield('page_title')</h2>
            </div>

            @yield('content')

        </div>
    </section>

    <!-- REUSABLE MODAL -->

    <div class="modal fade " id="setting_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content modal-col-deep-purple">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Setting</h4>
                </div>
                <div class="modal-body">

                    <div class="modal-loader">
                        <div class="loader">
                            <div class="preloader">
                                <div class="spinner-layer pl-white">
                                    <div class="circle-clipper left">
                                        <div class="circle"></div>
                                    </div>
                                    <div class="circle-clipper right">
                                        <div class="circle"></div>
                                    </div>
                                </div>
                            </div>
                            <br />
                            <p>Please wait...</p>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" onclick="$(this).parent().parent().find('button:first').prop('type', 'submit').click()">SAVE CHANGES</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->

    <!-- Jquery Core Js -->
    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="/assets/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="/assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="/assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="/assets/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="/assets/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Morris Plugin Js -->
    <script src="/assets/plugins/raphael/raphael.min.js"></script>
    <script src="/assets/plugins/morrisjs/morris.js"></script>

    <script src="/assets/plugins/jquery-steps/jquery.steps.js"></script>
    <script src="/assets/plugins/dropzone/dropzone.js"></script>

    <!-- ChartJs -->
    <script src="/assets/plugins/chartjs/Chart.bundle.js"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="/assets/plugins/jquery-sparkline/jquery.sparkline.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Custom Js -->
    <script src="/assets/js/admin.js"></script>

    <script>

        $(document).ready(function() {
            //Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            //Popover
            $('[data-toggle="popover"]').popover();


            document.addEventListener('touchstart', function(){}, {passive: false})
        });

    </script>

    @livewireScripts
    @stack('scripts')

    @yield('js')
</body>

</html>
