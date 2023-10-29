@extends($layout)

@section('content')

@php
    $breadcums = ["Member Management", "Roles", "Summary"];
    $links = [
        ["title" => "Create", "url" => route($routePrefix . ".create")]
    ];
@endphp

<x-backend.page-header title="Role" :breadcums="$breadcums" :links="$links"/>

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route($routePrefix . '.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <x-inputs.text-field name="name" label="Name" :value="$name" autocomplete="off" />
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

<div class="card" id="page-summary">
    <div class="card-header">
        <x-backend.pagination-links :records="$records"/>
    </div>

    <div class="card-body">
        <table class="table table-striped table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th><?= sortable_anchor('id', 'ID') ?></th>
                    <th><?= sortable_anchor('name', 'Name') ?></th>
                    <th>System Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>
                        <x-backend.yes-no-label :value="$record->is_system_admin"/>
                    </td>
                    <td>
                        <x-backend.summary-comman-actions :id="$record->id" :routePrefix="$routePrefix"/>
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
