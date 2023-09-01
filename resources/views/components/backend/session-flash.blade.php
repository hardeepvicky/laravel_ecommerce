@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif

@if(Session::has('fail'))
<div class="alert alert-danger">
    {{ Session::get('fail') }}
    @php
        Session::forget('fail');
    @endphp
</div>
@endif