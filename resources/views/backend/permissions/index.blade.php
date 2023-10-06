@extends('layouts.app')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Permission Summary</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">                    
                    <li class="breadcrumb-item">System Manager</li>
                    <li class="breadcrumb-item">Permissions</li>
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
                    <x-inputs.drop-down name="section_name" value="$section_name" label="Sections" class="select2" :list="$section_list" />
                </div>
                <div class="col-md-3">                    
                    <x-inputs.drop-down name="role_id" label="Roles" class="select2" :list="$role_list" value="$role_id" />
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

@if(isset($records))
<div class="card">    
    <div class="card-body">        
        <table class="table table-striped table-bordered table-hover mb-0">
            <thead>
                <tr>
                    <th class="text-center">#</th>                    
                    <th>Section</th>
                    <th>Action</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $i => $record)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $record['section'] ?? "" }}</td>
                    <td>{{ $record['action'] ?? "" }}</td>
                    <td>{{ $record['role']['name'] }}</td>
                    <td>
                        
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection
