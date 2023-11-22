@extends($layout)

@section('content')

<?php
    $page_header_links = [
        
    ];
?>

@include($common_elements_path . ".page_header")

<div class="card">
    <div class="card-body">
        <span class="btn btn-secondary table-export-csv" data-sr-table-csv-export-target="table#summary" data-sr-table-csv-export-filename="Laravel-Routes">Export CSV (JS)</span>
        <table class="table table-striped table-bordered table-hover i-data-table mt-3" id="summary">
            <thead>
                <tr>
                    <th style="width:50px;" data-sort="numeric">#</th>
                    <th data-search="1" data-sort="text">URL</th>
                    <th data-search="1">Route Name</th>
                    <th data-search="1">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach($routes as $route):
                    $i++;
                ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $route['url'] ?></td>
                    <td><?= $route['route_name'] ?></td>
                    <td><?= $route['action'] ?></td>                    
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        
    </div>
</div>

@endsection