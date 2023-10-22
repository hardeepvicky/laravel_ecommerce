@extends('backend.layouts.default')

@section('content')
<div class="my-2 pt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="text-center mb-5">
                    <h1 class="display-1 fw-semibold">{{ $exception->getStatusCode() }}</h1>
                    <h4 class="text-uppercase">{{ $exception->getMessage() }}</h4>                    
                    <h6>
                        {{ Request::url() }}
                    </h6>
                </div>
            </div>
        </div>
    </div>
    <!-- end container -->
</div>
@endsection