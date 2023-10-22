<a class="btn btn-light" href="{{ route($routePrefix . '.edit',[$id]) }}">
    <i class="bx bx-edit-alt label-icon"></i>                            
</a>

<x-backend.summary-delete-button url="{{ route($routePrefix . '.destroy', [$id]) }}"/>