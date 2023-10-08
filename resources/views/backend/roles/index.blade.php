@extends($layout)

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Role</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">Role</li>
                    <li class="breadcrumb-item active">Summary</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route($routePrefix . '.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <x-inputs.text-field name="name" label="Name" :value="$name" autocomplete="off" />
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3">                   
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
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
