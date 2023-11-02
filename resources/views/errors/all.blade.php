@extends($layout)

@section('content')

<div class="my-2 pt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('errors.ajax.' . $status_code)
            </div>
        </div>
    </div>
</div>

@endsection