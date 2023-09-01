@extends('layouts.app')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">User Summary</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Summary</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ url('/users') }}">
            <div class="row">
                <div class="col-md-3">
                    <x-inputs.text-field name="name" label="Name" value="{{ ${$modelName . 'name'} }}" />
                </div>            
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3">                   
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Search</button>
                        <a href="/clear_search_cache/index" class="btn btn-light w-md">Clear</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ $records->links('pagination::bootstrap-4-with-info') }}
    </div>

    <div class="card-body">        
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->email }}</td>
                    <td>
                        <x-backend.summary-comman-actions :id="$record->id" />
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $records->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection
