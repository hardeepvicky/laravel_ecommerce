@extends($layout)

@section('content')

@php
    $breadcums = ["Logs", "Developer", "SQL"];
    $links = [];
@endphp

<x-backend.page-header title="SQL Logs" :breadcums="$breadcums" :links="$links"/>


<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route($routePrefix . '.index') }}">
            <div class="row mb-4">
                <div class="col-md-4">
                    <x-inputs.text-field name="route_name_or_url" label="Route Name or URL" :value="$route_name_or_url" autocomplete="off" />
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
                    <th>Route Name / Url</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->route_name_or_url }}</td>
                    <td>
                        <a download="sql_{{ $record->id }}.txt" href="/{{ $record->sql_log_file }}" class="btn btn-soft-info waves-effect waves-light">
                            <i class="fas fa-download"></i>
                            SQL Log
                        </a>
                        @if($record->sql_dml_log_file)
                        <a download="sql_dml_{{ $record->id }}.txt" href="/{{ $record->sql_dml_log_file }}" class="btn btn-soft-info waves-effect waves-light">
                            <i class="fas fa-download"></i>
                            DML SQL Log
                        </a>
                        @endif
                    </td>
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
