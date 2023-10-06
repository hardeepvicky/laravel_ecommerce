<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>Dashboard | Minia - Minimal Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <!-- plugin css -->
        <link href="/assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />

        <!-- preloader css -->
        <link rel="stylesheet" href="/assets/css/preloader.min.css" type="text/css" />

        <link href="/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/libs/select2/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Bootstrap Css -->
        <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        
        <link href="/css/backend.css?<?= BACKEND_CSS_JS_VERSION ?>" rel="stylesheet" type="text/css" />
        <link href="/css/backend/default.css?<?= BACKEND_CSS_JS_VERSION ?>" rel="stylesheet" type="text/css" />

        <script src="/assets/libs/jquery/jquery.min.js"></script>
        <script src="/js/backend/constants.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
    </head>

    <body>

    <!-- <body data-layout="horizontal"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            <x-backend.header/>

            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <x-backend.menu-show/>
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

        <!-- JAVASCRIPT -->        
        <script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/assets/libs/node-waves/waves.min.js"></script>
        <script src="/assets/libs/feather-icons/feather.min.js"></script>
        
        <script src="/assets/libs/pace-js/pace.min.js"></script>
        <script src="/assets/libs/select2/select2.min.js"></script>

        <script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
        
        <script src="/assets/libs/sweetalert2/sweetalert2.min.js"></script>

        <script src="/assets/js/app.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>

        <script src="/js/backend.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script src="/js/backend/ajax.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>
        <script src="/js/backend/default.js?<?= BACKEND_CSS_JS_VERSION ?>"></script>

        <script type="text/javascript">
            $("body").srLoader();
        </script>
    </body>

</html>
