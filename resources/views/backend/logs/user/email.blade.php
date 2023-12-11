@extends($layout)

@section('content')

<?php
    $page_header_links = [];
?>

@include($common_elements_path . ".page_header")


<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route($routePrefix . '.email') }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <x-inputs.text-field name="from_email" label="From Email" :value="$from_email" />
                </div>
                <div class="col-md-4">
                    <x-inputs.text-field name="to_email" label="To Email" :value="$to_email" />
                </div>
                <div class="col-md-4">
                    <x-inputs.text-field id="from_date" name="from_date" class="form-control date-picker" label="From Created Date" :value="$from_date" autocomplete="off" data-date-end="input#to_date" />
                </div>
                <div class="col-md-4">
                    <x-inputs.text-field id="to_date" name="to_date" class="form-control date-picker" label="To Created Date" :value="$to_date" autocomplete="off" data-date-start="input#from_date" />
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-md-4">
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Search</button>
                        <span class="btn btn-light w-md clear_form_search_conditions">Clear</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <x-backend.pagination-links :records="$records"/>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>From Name</th>
                    <th>From Email</th>
                    <th>To Name</th>
                    <th>To Email</th>                    
                    <th>Subject</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->from_name }}</td>
                    <td>{{ $record->from_email }}</td>
                    <td>{{ $record->to_name }}</td>
                    <td>{{ $record->to_email }}</td>
                    <td>{{ $record->subject }}</td>
                    <td>
                        <span class="btn btn-info btn-sm css-toggler ajax-load"
                            data-sr-css-class-toggle-target="#record-{{ $record->id }}" data-sr-css-class-toggle-class="hidden"
                            data-sr-ajax-load-url="/{{ $record->content_file }}" data-sr-ajax-load-target="#record-{{ $record->id }} .details"
                        >
                            Details
                        </span>
                    </td>
                </tr>
                <tr id="record-{{ $record->id }}" class="hidden">
                    <td></td>
                    <td class="details" style="background-color:#EEE" colspan="5">

                    </td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <x-backend.pagination-links :records="$records"/>
    </div>
</div>

@endsection
