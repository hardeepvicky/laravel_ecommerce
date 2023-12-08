<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title<?php echo isset($page_title) ? $page_title : "Page Title is not set"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Test Laravel" name="description" />
        <meta content="Hardeep" name="author" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/favicon.ico">

        <link rel="stylesheet"  type="text/css" href="/assets/css/app.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/bootstrap.min.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/preloader.min.css"/>
        <link rel="stylesheet"  type="text/css" href="/assets/css/icons.min.css" />

        <link rel="stylesheet"  type="text/css" href="/assets/libs/select2/select2.min.css" />
        <link rel="stylesheet"  type="text/css" href="/assets/libs/select2/select2-bootstrap.min.css"/>
        <link rel="stylesheet"  type="text/css" href="/assets/libs/sweetalert2/sweetalert2.min.css" />
        <link rel="stylesheet"  type="text/css" href="/assets/libs/Croppie-2.6.4/croppie.css" />
        <link rel="stylesheet"  type="text/css" href="/assets/libs/fancybox/dist/jquery.fancybox.min.css" />

        <link rel="stylesheet" type="text/css"  href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" type="text/css"  href="/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" type="text/css"  href="/assets/libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" type="text/css"  href="/assets/libs/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" />

        <!-- Project related CSS -->
        <link rel="stylesheet"  type="text/css" href="/css/backend/default.css?<?= BACKEND_CSS_VERSION ?>" />

        <!-- Pre javascript -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>
    </head>

    <body>
        <script type="text/javascript">
            var mode = localStorage.getItem("layout-mode");
            if (mode)
            {
                $("body").attr("data-layout-mode", mode).attr("data-topbar", mode).attr("data-sidebar", mode);
            }
        </script>
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include("backend.common_elements.header")

            <div class="vertical-menu">
                <div data-simplebar class="h-100">
                    @include("backend.common_elements.menu")
                </div>
            </div>

            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">

                        <x-backend.session-flash />

                        @yield('content')

                    </div>
                </div>

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © <?= SITE_NAME ?>.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by <a href="#!" class="text-decoration-underline"><?= SITE_DEVELOP_BY ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <!-- Theme Required File -->
        <script type="text/javascript" src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="/assets/libs/bootbox/5.5.3/bootbox.min.js"></script>
        <script type="text/javascript" src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script type="text/javascript" src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script type="text/javascript" src="/assets/libs/node-waves/waves.min.js"></script>
        <script type="text/javascript" src="/assets/libs/feather-icons/feather.min.js"></script>
        <script type="text/javascript" src="/assets/js/app.js"></script>

        <script type="text/javascript" src="/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script type="text/javascript" src="/assets/libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
        <script type="text/javascript" src="/assets/libs/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

        <script type="text/javascript" src="/assets/libs/select2/select2.min.js"></script>
        <script type="text/javascript" src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>
        <script type="text/javascript" src="/assets/libs/Croppie-2.6.4/croppie.min.js"></script>
        <script type="text/javascript" src="/assets/libs/fancybox/dist/jquery.fancybox.min.js"></script>
        <script type="text/javascript" src="/assets/libs/jquery.form.min.js"></script>

        <!--- Libs Made by developer -->
        <script src="/libs/constants.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>
        <script src="/libs/events.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>
        <script src="/libs/jquery-input-validate.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>
        <script src="/libs/date-util.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>
        <script src="/libs/jquery_extend.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>
        <script src="/libs/bootstrap_extend.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>

        <link href="/libs/loader/loader.css?<?= BACKEND_JS_VERSION ?>" rel="stylesheet" type="text/css" />
        <script src="/libs/loader/loader.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>

        <link href="/libs/i-data-table/style.css?<?= BACKEND_JS_VERSION ?>" rel="stylesheet" type="text/css"  />
        <script src="/libs/i-data-table/script.js?<?= BACKEND_JS_VERSION ?>" type="text/javascript" ></script>

        <!-- Project related JS -->
        <script type="text/javascript" src="/js/backend/backend.js?<?= BACKEND_JS_VERSION ?>"></script>
    </body>
</html>
