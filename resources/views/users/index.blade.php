@extends('layouts.app')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">User Summary</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Summary</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-header">
        {{ $records->links('pagination::bootstrap-4-with-info') }}
    </div>

    <div class="card-body">        
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->name }}</td>
                    <td>{{ $record->email }}</td>
                    <td>
                        <a class="btn btn-light" href="{{ url('users/' . $record->id . '/edit') }}">
                            <i class="bx bx-edit-alt label-icon"></i>                            
                        </a>
                        <form action="{{ url('users/' . $record->id ) }}" method="POST" class="delete" style="display:inline-block;">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger">
                                <i class="bx bx-trash label-icon"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $records->links('pagination::bootstrap-4') }}
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function()
    {
        $("form.delete").submit(function()
        {
            var _form = $(this);

            var is_confirm = _form.attr("data-confirm");

            if (!is_confirm)
            {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: !0,
                    confirmButtonColor: "#2ab57d",
                    cancelButtonColor: "#fd625e",
                    confirmButtonText: "Yes, delete it!"
                }).then(function(e) {
                    if (e.value)
                    {
                        _form.attr("data-confirm", 1);
                        _form.trigger("submit");
                    }
                });

                return false;
            }
        });
    });
</script>

@endsection
