@extends($layout)

@section('content')
@php 
    $breadcums = ["Member Management", "Users", "Summary", "Edit"];
    $links = [
        ["title" => "Summary", "url" => route($routePrefix . ".index")]
    ];
@endphp 

<x-backend.page-header title="User Edit" :breadcums="$breadcums" :links="$links"/>

<x-backend.form-errors />

<form action="{{ $form['url'] }}" method="POST">
    {!! csrf_field() !!}    
    {{ method_field($form['method']) }}
    <div class="row">
        <div class="offset-lg-4 col-lg-4">
            <div class="form-group mb-3">
                <x-inputs.text-field name="name" label="Name" placeholder="Enter Name" value="{{ $model->name }}" />
            </div>  
            <div class="form-group mb-3">
                <x-inputs.text-field type="email" name="email" label="Email" placeholder="Enter Email" value="{{ $model->email }}" />
            </div>            
            <div class="form-group mb-3">
                <x-inputs.drop-down name="roles[]" label="Roles" class="select2" :list="$role_list" multiple="multiple" value="{{ implode(',', $model->userRole->pluck('role_id')->toArray()) }}" />
            </div>            
        </div>
    </div>
    <div class="mt-2 mb-2 d-flex justify-content-center">
        <button type="submit" class="btn btn-primary" style="margin-right: 5px;">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
@endsection
