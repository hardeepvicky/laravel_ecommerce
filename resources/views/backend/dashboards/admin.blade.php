@extends($layout)

@section('content')

<h1>Welcome To Admin DashBoard</h1>

<div class="card-body">
    {{ $msg }}

    <h6>Layout : {{$layout}}</h6>

    <br/><br/>
    <a class="btn btn-primary" href="/theme">Goto Theme</a>
    <br/><br/>
    <a class="btn btn-secondary"  href="/developer-components">Goto Components Made By Developers</a>
</div>

@endsection