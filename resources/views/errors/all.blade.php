@extends($layout)

@section('content')
    @include('errors.ajax.' . $status_code)
@endsection