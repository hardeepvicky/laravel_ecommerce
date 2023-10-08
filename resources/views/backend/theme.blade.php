@extends('backend.layouts.default')

@section('content')

<h3>
    File located at resources/views/backend/theme.blade.php
</h3>

<h5>
    I have copy some required components from theme.
    <br/>
    It is Minia Theme you can see all components at <a href="https://themesbrand.com/minia/layouts/index.html"> Minia Theme Page </a>
    <br/>
    Or you can go to <a href="https://preview.themeforest.net/item/minia-bootstrap-5-admin-dashboard-template/full_screen_preview/32710967?_ga=2.134810486.600226943.1696759405-1015902644.1658336541&_gac=1.120593530.1696759405.Cj0KCQjwpompBhDZARIsAFD_Fp-pBCNwFGxK_n4nipzQYYS1nQWmoDELe73WssUnVapCpyeTBoGY_b4aAlLjEALw_wcB"> Themeforset page </a>
</h5>

<div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab_basic" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Basic</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_form" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Form</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_table" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Table</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_color" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Colors</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#tab_chart" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Charts</span>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-3">
        <div class="tab-pane active" id="tab_basic" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cards</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-xl-3">
                            <!-- Simple card -->
                            <div class="card">
                                <img class="card-img-top img-fluid" src="assets/images/small/img-1.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make
                                        up the bulk of the card's content.</p>
                                    <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light">Button</a>
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="col-md-6 col-xl-3">

                            <div class="card">
                                <img class="card-img-top img-fluid" src="assets/images/small/img-2.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <p class="card-text">Some quick example text to build on the card title and make
                                        up the bulk of the card's content.</p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Cras justo odio</li>
                                    <li class="list-group-item">Dapibus ac facilisis in</li>
                                </ul>
                                <div class="card-body">
                                    <a href="javascript: void(0);" class="card-link">Card link</a>
                                    <a href="javascript: void(0);" class="card-link">Another link</a>
                                </div>
                            </div>

                        </div><!-- end col -->

                        <div class="col-md-6 col-xl-3">

                            <div class="card">
                                <img class="card-img-top img-fluid" src="assets/images/small/img-3.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make
                                        up the bulk of the card's content.</p>
                                </div>
                            </div>

                        </div><!-- end col -->


                        <div class="col-md-6 col-xl-3">

                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Card title</h4>
                                    <h6 class="card-subtitle text-muted">Support card subtitle</h6>
                                </div>
                                <img class="img-fluid" src="assets/images/small/img-4.jpg" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make
                                        up the bulk of the card's content.</p>
                                    <a href="javascript: void(0);" class="card-link">Card link</a>
                                    <a href="javascript: void(0);" class="card-link">Another link</a>
                                </div>
                            </div>

                        </div><!-- end col -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Alerts</h4>
                    <p class="card-title-desc">Add a dismiss button and the .alert-dismissible class, which adds extra padding to the right of the alert and positions the .btn-close button.</p>
                </div>
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        A simple success alert—check it out!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        A simple danger alert—check it out!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        A simple warning alert—check it out!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <div class="alert alert-info alert-dismissible fade show mb-0" role="alert">
                        A simple info alert—check it out!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Big Card Type Alerts</h4>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-sm-3">                            
                            <div class="alert alert-success alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                <i class="mdi mdi-check-all d-block display-4 mt-2 mb-3 text-success"></i>
                                <h5 class="text-success">Success</h5>
                                <p>A simple success alert</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div><!-- end col -->

                        <div class="col-sm-3">
                            <div class="alert alert-danger alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                <i class="mdi mdi-block-helper d-block display-4 mt-2 mb-3 text-danger"></i>
                                <h5 class="text-danger">Error</h5>
                                <p>A simple danger alert</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div><!-- end col -->

                        <div class="col-sm-3">
                            <div class="alert alert-warning alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                <i class="mdi mdi-alert-outline d-block display-4 mt-2 mb-3 text-warning"></i>
                                <h5 class="text-warning">Warning</h5>
                                <p>A simple warning alert</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div><!-- end col -->

                        <div class="col-sm-3">
                            <div class="alert alert-info alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                                <i class="mdi mdi-alert-circle-outline d-block display-4 mt-2 mb-3 text-info"></i>
                                <h5 class="text-info">Info</h5>
                                <p>A simple info alert</p>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div><!-- end col -->
                    </div><!-- end row -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Default Modal</h4>
                            <p class="card-title-desc">Toggle a working modal demo by clicking the button below. It will slide down and fade in from the top of the page.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#myModal">Standard modal</button>

                                <!-- sample modal content -->
                                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" data-bs-scroll="true" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Default Modal Heading</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Overflowing text to show scroll behavior</h5>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Vivamus sagittis lacus vel
                                                    augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur.
                                                    Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Donec sed odio dui. Donec
                                                    ullamcorper nulla non metus auctor
                                                    fringilla.</p>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Vivamus sagittis lacus vel
                                                    augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur.
                                                    Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Donec sed odio dui. Donec
                                                    ullamcorper nulla non metus auctor
                                                    fringilla.</p>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div> <!-- end preview-->

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Fullscreen Modal</h4>
                            <p class="card-title-desc">Another override is the option to pop up a modal that covers the user viewport, available via modifier classes that are placed a <code>.modal-fullscreen</code>.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">Fullscreen modal</button>

                                <!-- sample modal content -->
                                <div id="exampleModalFullscreen" class="modal fade" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalFullscreenLabel">Fullscreen Modal</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Overflowing text to show scroll behavior</h5>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Vivamus sagittis lacus vel
                                                    augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur.
                                                    Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Donec sed odio dui. Donec
                                                    ullamcorper nulla non metus auctor
                                                    fringilla.</p>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Vivamus sagittis lacus vel
                                                    augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur.
                                                    Praesent commodo cursus magna, vel scelerisque
                                                    nisl consectetur et. Donec sed odio dui. Donec
                                                    ullamcorper nulla non metus auctor
                                                    fringilla.</p>
                                                <p>Cras mattis consectetur purus sit amet fermentum.
                                                    Cras justo odio, dapibus ac facilisis in,
                                                    egestas eget quam. Morbi leo risus, porta ac
                                                    consectetur ac, vestibulum at eros.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div> <!-- end preview-->
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>


            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Split Button Dropdowns</h4>
                    <p class="card-title-desc">The best part is you can do this with any button variant, too:</p>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="d-flex gap-2 flex-wrap">
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary">Primary</button>
                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" style="">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-secondary">Secondary</button>
                            <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-success">Success</button>
                            <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-info">Info</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-warning">Warning</button>
                            <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger">Danger</button>
                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </div><!-- /btn-group -->
                    </div>
                </div><!-- end card-body -->
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Badges</h4>
                            <p class="card-title-desc">Add any of the below mentioned modifier classes to change the appearance of a badge.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <h5 class="font-size-14">Default</h5>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <span class="badge bg-primary">Primary</span>
                                    <span class="badge bg-success">Success</span>
                                    <span class="badge bg-info">Info</span>
                                    <span class="badge bg-warning">Warning</span>
                                    <span class="badge bg-danger">Danger</span>
                                    <span class="badge bg-dark">Dark</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="font-size-14">Soft Badge</h5>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <span class="badge badge-soft-primary">Primary</span>
                                    <span class="badge badge-soft-success">Success</span>
                                    <span class="badge badge-soft-info">Info</span>
                                    <span class="badge badge-soft-warning">Warning</span>
                                    <span class="badge badge-soft-danger">Danger</span>
                                    <span class="badge badge-soft-dark">Dark</span>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pill Badges</h4>
                            <p class="card-title-desc">Use the <code>.rounded-pill</code> modifier class to make
                                badges more rounded.
                            </p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <h5 class="font-size-14">Default</h5>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <span class="badge rounded-pill bg-primary">Primary</span>
                                    <span class="badge rounded-pill bg-success">Success</span>
                                    <span class="badge rounded-pill bg-info">Info</span>
                                    <span class="badge rounded-pill bg-warning">Warning</span>
                                    <span class="badge rounded-pill bg-danger">Danger</span>
                                    <span class="badge rounded-pill bg-dark">Dark</span>
                                </div>
                            </div>

                            <div class="mt-4">
                                <h5 class="font-size-14">Soft Badge</h5>
                                <div class="d-flex flex-wrap gap-2 mt-1">
                                    <span class="badge rounded-pill badge-soft-primary">Primary</span>
                                    <span class="badge rounded-pill badge-soft-success">Success</span>
                                    <span class="badge rounded-pill badge-soft-info">Info</span>
                                    <span class="badge rounded-pill badge-soft-warning">Warning</span>
                                    <span class="badge rounded-pill badge-soft-danger">Danger</span>
                                    <span class="badge rounded-pill badge-soft-dark">Dark</span>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Badges in Buttons</h4>
                            <p class="card-title-desc">Badges can be used as part of links or buttons to provide a counter.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-primary">
                                    Notifications <span class="badge bg-success ms-1">4</span>
                                </button>
                                <button type="button" class="btn btn-success">
                                    Messages <span class="badge bg-danger ms-1">2</span>
                                </button>
                                <button type="button" class="btn btn-outline-secondary">
                                    Draft <span class="badge bg-success ms-1">2</span>
                                </button>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Badges Position Examples</h4>
                            <p class="card-title-desc">Example of Badges Position</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-3">
                                <button type="button" class="btn btn-primary position-relative">
                                    Mails <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">+99 <span class="visually-hidden">unread messages</span></span>
                                </button>


                                <button type="button" class="btn btn-light position-relative">
                                    Alerts <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">unread messages</span></span>
                                </button>

                                <button type="button" class="btn btn-primary position-relative p-0 avatar-sm rounded">
                                    <span class="avatar-title bg-transparent">
                                        <i class="bx bxs-envelope"></i>
                                    </span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger p-1"><span class="visually-hidden">unread messages</span></span>
                                </button>

                                <button type="button" class="btn btn-light position-relative p-0 avatar-sm rounded-circle">
                                    <span class="avatar-title bg-transparent text-reset">
                                        <i class="bx bxs-bell"></i>
                                    </span>
                                </button>

                                <button type="button" class="btn btn-light position-relative p-0 avatar-sm rounded-circle">
                                    <span class="avatar-title bg-transparent text-reset">
                                        <i class="bx bx-menu"></i>
                                    </span>
                                    <span class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-success p-1"><span class="visually-hidden">unread messages</span></span>
                                </button>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Default Examples</h4>
                            <p class="card-title-desc">Progress components are built with two
                                HTML elements, some CSS to set the width, and a few attributes.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Backgrounds</h4>
                            <p class="card-title-desc">Use background utility classes to
                                change the appearance of individual progress bars.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Labels Example</h4>
                            <p class="card-title-desc">Add labels to your progress bars by placing text within the <code class="highlighter-rouge">.progress-bar</code>.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Multiple bars</h4>
                            <p class="card-title-desc">Include multiple progress bars in a progress component if you need.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Striped</h4>
                            <p class="card-title-desc">Add <code>.progress-bar-striped</code>
                                to any <code>.progress-bar</code> to apply a
                                stripe via CSS gradient over the progress bar’s background color.
                            </p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="progress mb-4">
                                <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress mb-0">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Animated stripes</h4>
                            <p class="card-title-desc">The striped gradient can also be
                                animated. Add <code>.progress-bar-animated</code> to <code>.progress-bar</code> to animate the
                                stripes right to left via CSS3 animations.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Progress Example</h5>
                            <p class="card-title-desc">You can use these classes with existing components to create new ones.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="position-relative m-4">
                                <div class="progress" style="height: 1px;">
                                    <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <button type="button" class="position-absolute top-0 start-0 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">1</button>
                                <button type="button" class="position-absolute top-0 start-50 translate-middle btn btn-sm btn-primary rounded-pill" style="width: 2rem; height:2rem;">2</button>
                                <button type="button" class="position-absolute top-0 start-100 translate-middle btn btn-sm btn-secondary rounded-pill" style="width: 2rem; height:2rem;">3</button>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Border Spinner</h4>
                            <p class="card-title-desc">Use the border spinners for a lightweight loading indicator.</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="spinner-border text-primary m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-secondary m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-success m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-info m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-warning m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-danger m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-border text-dark m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Growing Spinner</h4>
                            <p class="card-title-desc">If you don’t fancy a border spinner, switch to the grow spinner. While it doesn’t technically spin, it does repeatedly grow!</p>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div>
                                <div class="spinner-grow text-primary m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-secondary m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-success m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-info m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-warning m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-danger m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="spinner-grow text-dark m-1" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>



            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Default Tabs</h4>
                    <p class="card-title-desc">Use the tab JavaScript plugin—include
                        it individually or through the compiled <code class="highlighter-rouge">bootstrap.js</code>
                        file—to extend our navigational tabs and pills to create tabbable panes
                        of local content, even via dropdown menus.</p>
                </div><!-- end card header -->

                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#home" role="tab" aria-selected="true">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#profile" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#messages" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">Messages</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#settings" role="tab" aria-selected="false">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Settings</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <p class="mb-0">
                                Raw denim you probably haven't heard of them jean shorts Austin.
                                Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                iphone. Seitan aliquip quis cardigan american apparel, butcher
                                voluptate nisi qui.
                            </p>
                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <p class="mb-0">
                                Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                single-origin coffee squid. Exercitation +1 labore velit, blog
                                sartorial PBR leggings next level wes anderson artisan four loko
                                farm-to-table craft beer twee. Qui photo booth letterpress,
                                commodo enim craft beer mlkshk aliquip jean shorts ullamco ad
                                vinyl cillum PBR. Homo nostrud organic, assumenda labore
                                aesthetic magna delectus.
                            </p>
                        </div>
                        <div class="tab-pane" id="messages" role="tabpanel">
                            <p class="mb-0">
                                Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                farm-to-table readymade. Messenger bag gentrify pitchfork
                                tattooed craft beer, iphone skateboard locavore carles etsy
                                salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                mi whatever gluten yr.
                            </p>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <p class="mb-0">
                                Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                art party before they sold out master cleanse gluten-free squid
                                scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                art party locavore wolf cliche high life echo park Austin. Cred
                                vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                farm-to-table VHS.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Vertical Nav Tabs</h4>
                    <p class="card-title-desc">Example of Vertical nav tabs</p>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <a class="nav-link mb-2" id="v-pills-home-tab" data-bs-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false">Home</a>
                                <a class="nav-link mb-2" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                                <a class="nav-link mb-2" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                                <a class="nav-link active" id="v-pills-settings-tab" data-bs-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="true">Settings</a>
                            </div>
                        </div><!-- end col -->
                        <div class="col-md-9">
                            <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                                <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                    <p>
                                        Raw denim you probably haven't heard of them jean shorts Austin.
                                        Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache
                                        cliche tempor, williamsburg carles vegan helvetica. Reprehenderit
                                        butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                        qui irure terry richardson ex squid. Aliquip placeat salvia cillum
                                        iphone. Seitan aliquip quis cardigan.
                                    </p>
                                    <p>Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                                        qui irure terry richardson ex squid.</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                    <p>
                                        Food truck fixie locavore, accusamus mcsweeney's marfa nulla
                                        single-origin coffee squid. Exercitation +1 labore velit, blog
                                        sartorial PBR leggings next level wes anderson artisan four loko
                                        farm-to-table craft beer twee. Qui photo booth letterpress,
                                        commodo enim craft beer mlkshk.
                                    </p>
                                    <p class="mb-0"> Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna 8-bit</p>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                    <p>
                                        Etsy mixtape wayfarers, ethical wes anderson tofu before they
                                        sold out mcsweeney's organic lomo retro fanny pack lo-fi
                                        farm-to-table readymade. Messenger bag gentrify pitchfork
                                        tattooed craft beer, iphone skateboard locavore carles etsy
                                        salvia banksy hoodie helvetica. DIY synth PBR banksy irony.
                                        Leggings gentrify squid 8-bit cred.
                                    </p>
                                    <p class="mb-0">DIY synth PBR banksy irony.
                                        Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh
                                        mi whatever gluten-free.</p>
                                </div>
                                <div class="tab-pane fade active show" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                                    <p>
                                        Trust fund seitan letterpress, keytar raw denim keffiyeh etsy
                                        art party before they sold out master cleanse gluten-free squid
                                        scenester freegan cosby sweater. Fanny pack portland seitan DIY,
                                        art party locavore wolf cliche high life echo park Austin. Cred
                                        vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                        farm-to-table.
                                    </p>
                                    <p class="mb-0">Fanny pack portland seitan DIY,
                                        art party locavore wolf cliche high life echo park Austin. Cred
                                        vinyl keffiyeh DIY salvia PBR, banh mi before they sold out
                                        farm-to-table.
                                    </p>
                                </div>
                            </div>
                        </div><!--  end col -->
                    </div><!-- end row -->
                </div><!-- end card-body -->
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Media Object</h4>
                    <p class="card-title-desc">The images or other media can be
                        aligned top, middle, or bottom. The default is top aligned.
                    </p>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded avatar-md" src="assets/images/users/avatar-3.jpg" alt="Generic placeholder image">
                        </div>
                        <div class="flex-grow-1">
                            <h5>Top-aligned media</h5>
                            <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded avatar-md" src="assets/images/users/avatar-5.jpg" alt="Generic placeholder image">
                        </div>
                        <div class="flex-grow-1">
                            <h5>Center-aligned media</h5>
                            <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex align-items-end">
                        <div class="flex-shrink-0 me-3">
                            <img class="rounded avatar-md" src="assets/images/users/avatar-1.jpg" alt="Generic placeholder image">
                        </div>
                        <div class="flex-grow-1">
                            <h5>Bottom-aligned media</h5>
                            <p class="mb-0">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
                        </div>
                    </div>
                </div><!-- end card-body -->
            </div>
        </div>





        <div class="tab-pane" id="tab_form" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Textual inputs</h4>
                    <p class="card-title-desc">Here are examples of <code>.form-control</code> applied to each
                        textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                </div>
                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-lg-6">
                            <div>
                                <div class="mb-3">
                                    <label for="example-text-input" class="form-label">Text</label>
                                    <input class="form-control" type="text" value="Artisanal kale" id="example-text-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-search-input" class="form-label">Search</label>
                                    <input class="form-control" type="search" value="How do I shoot web" id="example-search-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-email-input" class="form-label">Email</label>
                                    <input class="form-control" type="email" value="bootstrap@example.com" id="example-email-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-url-input" class="form-label">URL</label>
                                    <input class="form-control" type="url" value="https://getbootstrap.com" id="example-url-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-tel-input" class="form-label">Telephone</label>
                                    <input class="form-control" type="tel" value="1-(555)-555-5555" id="example-tel-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-password-input" class="form-label">Password</label>
                                    <input class="form-control" type="password" value="hunter2" id="example-password-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-number-input" class="form-label">Number</label>
                                    <input class="form-control" type="number" value="42" id="example-number-input">
                                </div>
                                <div>
                                    <label for="example-datetime-local-input" class="form-label">Date and time</label>
                                    <input class="form-control" type="datetime-local" value="2019-08-19T13:45:00" id="example-datetime-local-input">
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mt-3 mt-lg-0">
                                <div class="mb-3">
                                    <label for="example-date-input" class="form-label">Date</label>
                                    <input class="form-control" type="date" value="2019-08-19" id="example-date-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-month-input" class="form-label">Month</label>
                                    <input class="form-control" type="month" value="2019-08" id="example-month-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-week-input" class="form-label">Week</label>
                                    <input class="form-control" type="week" value="2019-W33" id="example-week-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-time-input" class="form-label">Time</label>
                                    <input class="form-control" type="time" value="13:45:00" id="example-time-input">
                                </div>
                                <div class="mb-3">
                                    <label for="example-color-input" class="form-label">Color picker</label>
                                    <input type="color" class="form-control form-control-color mw-100" id="example-color-input" value="#5156be" title="Choose your color">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Select</label>
                                    <select class="form-select">
                                        <option>Select</option>
                                        <option>Large select</option>
                                        <option>Small select</option>
                                    </select>
                                </div>

                                <div>
                                    <label for="exampleDataList" class="form-label">Datalists</label>
                                    <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                                    <datalist id="datalistOptions">
                                        <option value="San Francisco">
                                        </option>
                                        <option value="New York">
                                        </option>
                                        <option value="Seattle">
                                        </option>
                                        <option value="Los Angeles">
                                        </option>
                                        <option value="Chicago">
                                        </option>
                                    </datalist>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="tab-pane" id="tab_table" role="tabpanel">

            <div class="row">
                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Striped, Bordered, Hover</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover mb-0">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Responsive table</h4>
                            <p class="card-title-desc">
                                Create responsive tables by wrapping any <code>.table</code> in
                                <code>.table-responsive</code>
                                to make them scroll horizontally on small devices (under 768px).
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                            <th>Table heading</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                            <td>Table cell</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <!-- end card body -->
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Small table</h4>
                            <p class="card-title-desc"> Add <code>.table-sm</code> to make tables more compact by
                                cutting cell padding in half.</p>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm m-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">4</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">5</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>







        <div class="tab-pane" id="tab_color" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Grid options</h4>
                    <p class="card-title-desc">See how aspects of the Bootstrap grid
                        system work across multiple devices with a handy table.</p>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-nowrap align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Colors
                                    </th>
                                    <th scope="col" colspan="2" class="text-center">
                                        Background <br> Gradient
                                    </th>
                                    <th scope="col" colspan="2" class="text-center">
                                        Background <br> Color
                                    </th>
                                    <th scope="col" colspan="2" class="text-center">
                                        Background <br> Soft
                                    </th>
                                    <th scope="col" colspan="2" class="text-center">
                                        Border <br> Colors
                                    </th>
                                    <th scope="col" colspan="2" class="text-center">
                                        Text <br> Colors
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th class="" scope="row">
                                        Primary
                                    </th>
                                    <td style="width: 100px;">
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td style="width: 180px;">
                                        <div class="bg-primary bg-gradient p-2"></div>
                                    </td>
                                    <td style="width: 100px;">
                                        <code>.bg-primary</code>
                                    </td>
                                    <td style="width: 180px;">
                                        <div class="bg-primary p-2"></div>
                                    </td>
                                    <td style="width: 100px;">
                                        <code>.bg-soft-primary</code>
                                    </td>
                                    <td style="width: 180px;">
                                        <div class="bg-soft-primary p-2"></div>
                                    </td>
                                    <td style="width: 100px;">
                                        <code>.border-primary</code>
                                    </td>
                                    <td style="width: 180px;">
                                        <div class="border border-primary p-2"></div>
                                    </td>
                                    <td style="width: 100px;">
                                        <code>.text-primary</code>
                                    </td>
                                    <td style="width: 100px;">
                                        <div class="text-primary">text-primary</div>
                                    </td>
                                </tr>


                                <tr>
                                    <th class="" scope="row">
                                        Secondary
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-secondary bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-secondary</code>
                                    </td>
                                    <td>
                                        <div class="bg-secondary p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-secondary</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-secondary p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-secondary</code>
                                    </td>
                                    <td>
                                        <div class="border border-secondary p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-secondary</code>
                                    </td>
                                    <td>
                                        <div class="text-secondary">text-secondary</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Success
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-success bg-gradient p-2 align-self-center"></div>
                                    </td>
                                    <td>
                                        <code>.bg-success</code>
                                    </td>
                                    <td>
                                        <div class="bg-success p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-success</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-success p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-success</code>
                                    </td>
                                    <td>
                                        <div class="border border-success p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-success</code>
                                    </td>
                                    <td>
                                        <div class="text-success">text-success</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Info
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-info bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-info</code>
                                    </td>
                                    <td>
                                        <div class="bg-info p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-info</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-info p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-info</code>
                                    </td>
                                    <td>
                                        <div class="border border-info p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-info</code>
                                    </td>
                                    <td>
                                        <div class="text-info">text-info</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Warning
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-warning bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-warning</code>
                                    </td>
                                    <td>
                                        <div class="bg-warning p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-warning</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-warning p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-warning</code>
                                    </td>
                                    <td>
                                        <div class="border border-warning p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-warning</code>
                                    </td>
                                    <td>
                                        <div class="text-warning">text-warning</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Danger
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-danger bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-danger</code>
                                    </td>
                                    <td>
                                        <div class="bg-danger p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-danger</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-danger p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-danger</code>
                                    </td>
                                    <td>
                                        <div class="border border-danger p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-danger</code>
                                    </td>
                                    <td>
                                        <div class="text-danger">text-danger</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Dark
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-dark bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-dark</code>
                                    </td>
                                    <td>
                                        <div class="bg-dark p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-dark</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-dark p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-dark</code>
                                    </td>
                                    <td>
                                        <div class="border border-dark p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-dark</code>
                                    </td>
                                    <td>
                                        <div class="text-dark">text-dark</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Light
                                    </th>
                                    <td>
                                        <code>.bg-gradient</code>
                                    </td>
                                    <td>
                                        <div class="bg-light bg-gradient p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-light</code>
                                    </td>
                                    <td>
                                        <div class="bg-light p-2"></div>
                                    </td>
                                    <td>
                                        <code>.bg-soft-light</code>
                                    </td>
                                    <td>
                                        <div class="bg-soft-light p-2"></div>
                                    </td>
                                    <td>
                                        <code>.border-light</code>
                                    </td>
                                    <td>
                                        <div class="border border-light p-2"></div>
                                    </td>
                                    <td>
                                        <code>.text-light</code>
                                    </td>
                                    <td>
                                        <div class="text-light bg-dark">text-light</div>
                                    </td>
                                </tr>


                                <tr>
                                    <th class="" scope="row">
                                        Body
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-body</code>
                                    </td>
                                    <td>
                                        <div class="text-body">text-body</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Muted
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-muted</code>
                                    </td>
                                    <td>
                                        <div class="text-muted">text-muted</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        White
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-white</code>
                                    </td>
                                    <td>
                                        <div class="text-white bg-dark">text-white</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        White-50
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-white-50</code>
                                    </td>
                                    <td>
                                        <div class="text-white-50 bg-dark">text-white-50</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Black-50
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-black-50</code>
                                    </td>
                                    <td>
                                        <div class="text-black-50">text-black-50</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Opacity-25
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center"><code>.opacity-25</code></div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="bg-primary opacity-25 p-2"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-opacity-25</code>
                                    </td>
                                    <td>
                                        <div class="text-opacity-25 text-primary">text-opacity-25</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Opacity-50
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center"><code>.opacity-50</code></div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="bg-primary opacity-50 p-2"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-opacity-50</code>
                                    </td>
                                    <td>
                                        <div class="text-opacity-50 text-primary">text-opacity-50</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Opacity-75
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center"><code>.opacity-75</code></div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="bg-primary opacity-75 p-2"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-opacity-75</code>
                                    </td>
                                    <td>
                                        <div class="text-opacity-75 text-primary">text-opacity-75</div>
                                    </td>
                                </tr>

                                <tr>
                                    <th class="" scope="row">
                                        Opacity-100
                                    </th>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center"><code>.opacity-100</code></div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <div class="bg-primary opacity-100 p-2"></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <div class="text-center">-</div>
                                    </td>
                                    <td>
                                        <code>.text-opacity-100</code>
                                    </td>
                                    <td>
                                        <div class="text-opacity-100 text-primary">text-opacity-100</div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div><!-- end card body -->
            </div>

        </div>






        <div class="tab-pane" id="tab_chart" role="tabpanel">

            <div class="row">
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Apexcharts</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Charts</a></li>
                                    <li class="breadcrumb-item active">Apexcharts</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line with Data Labels</h4>
                            </div>
                            <div class="card-body">

                                <div id="line_chart_datalabel" data-colors='["#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Dashed Line</h4>
                            </div>
                            <div class="card-body">

                                <div id="line_chart_dashed" data-colors='["#5156be", "#fd625e", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Spline Area</h4>
                            </div>
                            <div class="card-body">
                                <div id="spline_area" data-colors='["#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Column Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="column_chart" data-colors='["#2ab57d", "#5156be", "#fd625e"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Column with Data Labels</h4>
                            </div>
                            <div class="card-body">
                                <div id="column_chart_datalabel" data-colors='["#5156be"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Bar Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="bar_chart" data-colors='["#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Line, Column & Area Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="mixed_chart" data-colors='["#fd625e", "#5156be", "#2ab57d"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Radial Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="radial_chart" data-colors='["#5156be", "#2ab57d", "#fd625e", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div><!--end card-->

                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Pie Chart</h4>
                            </div>
                            <div class="card-body">

                                <div id="pie_chart" data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Donut Chart</h4>
                            </div>
                            <div class="card-body">
                                <div id="donut_chart" data-colors='["#2ab57d", "#5156be", "#fd625e", "#4ba6ef", "#ffbf53"]' class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div>

<script src="/assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="/assets/js/pages/apexcharts.init.js"></script>

@endsection