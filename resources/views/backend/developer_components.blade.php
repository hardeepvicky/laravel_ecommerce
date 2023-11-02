@extends('backend.layouts.default')

@section('content')

<h3>
    Due to lack of time i could not write documentation but i have write examples which are below 
    <br/>
    Please Goto the File and check code 

    <br/><br/>
    File located at resources/views/backend/developer_components.blade.php
</h3>

<div class="card-body">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#tab_loaders" role="tab" aria-selected="false">
                <span class="d-none d-sm-block">Loaders</span>
            </a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content pt-3">
        <div class="tab-pane active" id="tab_loaders" role="tabpanel">
            <div class="card-body">
                <span class="btn btn-light" id="show_loader">Default Loader</span>
                <span class="btn btn-light" id="show_loader2">Loader With Info</span>
                <span class="btn btn-light" id="show_loader3">Loader With Info Html And Footer Html</span>
                <div id="alert-success" style="display:none">
                    <div class="alert alert-success alert-dismissible fade show px-4 mb-0 text-center" role="alert">
                        <i class="mdi mdi-check-all d-block display-4 mt-2 mb-3 text-success"></i>
                        <h5 class="text-success">Success</h5>
                        <p>A simple success alert</p>                    
                    </div>
                </div>

                <span class="btn btn-light" id="show_loader4">Loader With Auto append html and Auto Close</span>

                <style>
                    .custom {
                        background-color: white;
                        color: rgba(var(--bs-primary-rgb));
                    }
                </style>

                <span class="btn btn-light" id="show_loader_custom_css_class">Show Default Loader with custom css class</span>

                <hr>


                <script type="text/javascript">
                    $(function() {

                        //must be called before any use
                        $.loader.init();

                        $("#show_loader").click(function() {
                            $.loader.show();
                        });

                        $("#show_loader2").click(function() {
                            $.loader
                                .setInfo("Loading...")
                                .show();
                        });

                        $("#show_loader3").click(function() {
                            $.loader.setInfo(
                                '<button type="button" class="btn btn-primary waves-effect btn-label waves-light"><i class="bx bx-smile label-icon"></i> Primary Button</button>'
                            );

                            $.loader.setFooter($('#alert-success').html());

                            $.loader.show();
                        });

                        $("#show_loader4").click(function() {
                            $.loader
                                .setFooter("<b>Counting 5 Seconds...</b>")
                                .show();

                            $.sr.wait(5, function(seconds) {

                                if (seconds > 0) {
                                    $.loader.appendHtmlInFooter("<br/>&bull; Second : " + seconds);
                                } else {
                                    console.log("last second called");
                                }
                            }, function() {

                                console.log("Stop Callback called");
                                $.loader.hide();
                            });
                        });

                        $("#show_loader_custom_css_class").click(function() {
                            $.loader.addCssClass("custom")
                                .setInfo("info")
                                .setFooter('Some Text Here')
                                .show();
                        });
                    });
                </script>
            </div>

        </div>


        <div class="tab-pane" id="tab_" role="tabpanel">
        </div>
    </div>
</div>

@endsection