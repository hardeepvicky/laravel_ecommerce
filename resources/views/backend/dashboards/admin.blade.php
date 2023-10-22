@extends($layout)

@section('content')

<h1>Welcome To Admin DashBoard</h1>

<div class="card-body">
    {{ $msg }}

    <h6>Layout : {{$layout}}</h6>
    <h6>View : {{$view_name}}</h6>

    <a class="btn btn-primary" href="/theme">Goto Theme</a>    
    <a class="btn btn-secondary"  href="/developer-components">Goto Components Made By Developers</a>
    <a class="btn btn-light"  href="/test">Goto Test Page</a>
</div>

@endsection