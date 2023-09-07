<a class="btn btn-light" href="{{ route($routePrefix . '.edit',[$id]) }}">
    <i class="bx bx-edit-alt label-icon"></i>                            
</a>
<form action="{{ url('users/' . $id ) }}" method="POST" class="delete" style="display:inline-block;">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button class="btn btn-danger">
        <i class="bx bx-trash label-icon"></i>
    </button>
</form>