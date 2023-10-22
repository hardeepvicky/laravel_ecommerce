<!doctype html>
<html lang="en">

    <head>

        <meta charset="utf-8" />
        <title>{{ SITE_NAME }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Test Laravel" name="description" />
        <meta content="Hardeep" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="/assets/images/favicon.ico">

        <link rel="stylesheet"  type="text/css" href="/assets/css/app.min.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/bootstrap.min.css"  />
        <link rel="stylesheet"  type="text/css" href="/assets/css/preloader.min.css"/>
        <link rel="stylesheet"  type="text/css" href="/assets/css/icons.min.css" />
        
        <!-- Project related CSS -->
        <link rel="stylesheet"  type="text/css" href="/css/backend/default.css?<?= BACKEND_CSS_JS_VERSION ?>" />

        <!-- Pre javascript -->
        <script src="/assets/libs/jquery/jquery.min.js"></script>        
    </head>

    <body>
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
        <script type="text/javascript"  src="/assets/libs/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript"  src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>        
        <script type="text/javascript"  src="/assets/libs/metismenu/metisMenu.min.js"></script>
        <script type="text/javascript"  src="/assets/js/app.js"></script>        
    </body>

</html>
