@extends('layouts.frontend.error')

@section('content')
<div class="my-5 pt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h1 class="display-1 fw-semibold">{{ $exception->getStatusCode() }}</h1>
                    <h5>{{ $exception->getMessage() }}</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>

@endsection