@extends($layout)

@section('content')

@php 
    $breadcums = ["Member Management", "Roles", "Create"];
    $links = [
        ["title" => "Summary", "url" => route($routePrefix . ".index")]
    ];
@endphp 

<x-backend.page-header title="Role" :breadcums="$breadcums" :links="$links"/>

<form action="{{ $form['url'] }}" method="POST">
    {!! csrf_field() !!}    
    {{ method_field($form['method']) }}
    <div class="row">
        <div class="offset-lg-4 col-lg-4">
            <div class="form-group mb-3">
                <x-inputs.text-field name="name" label="Name" placeholder="Enter Name" :value="$model->name" />
            </div>  
            <div class="form-group mb-3">
                <x-inputs.checkbox name="is_system_admin" label="System Admin" :value="$model->is_system_admin" />
            </div>            
        </div>
    </div>
    <div class="mt-2 mb-2 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>


@endsection