@extends($layout)

@section('content')
@php 
    $breadcums = ["Member Management", "Users", "Create"];
    $links = [
        ["title" => "Summary", "url" => route($routePrefix . ".index")]
    ];
@endphp 

<x-backend.page-header title="User Create" :breadcums="$breadcums" :links="$links"/>

<x-backend.form-errors />

<form action="{{ $form['url'] }}" method="POST">
    {!! csrf_field() !!}    
    {{ method_field($form['method']) }}
    <div class="row">
        <div class="offset-lg-4 col-lg-4">
            <div class="form-group mb-3">
                <x-inputs.text-field name="name" label="Name" placeholder="Enter Name" />
            </div>  
            <div class="form-group mb-3">
                <x-inputs.text-field type="email" name="email" label="Email" placeholder="Enter Email" />
            </div>            
            <div class="form-group mb-3">
                <x-inputs.text-field type="password" name="password" label="Password" placeholder="Enter Password" />                
            </div>            
            <div class="form-group mb-3">
                <x-inputs.text-field type="password" name="password_confirm" label="Confirm Password" placeholder="Enter Confirm Password" />                
            </div>            
        </div>
    </div>
    <div class="form-buttons">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
@endsection
