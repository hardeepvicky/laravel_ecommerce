@extends($layout)

@section('content')

<?php
    $page_header_links = [
        ["title" => "Create", "url" => route($routePrefix . ".create")]
    ];
?>

@include($common_elements_path . ".page_header")

<x-backend.form-errors />

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
    <div class="form-buttons">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>


@endsection