<div class="text-center mb-5">
    <h1 class="display-1 fw-semibold">{{ $exception->getStatusCode() }}</h1>
    <h4 class="text-uppercase">{{ $exception->getMessage() }}</h4>
    <h6>
        {{ Request::url() }}
    </h6>    
</div>