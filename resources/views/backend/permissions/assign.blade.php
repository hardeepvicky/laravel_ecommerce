@extends('layouts.app')

@section('content')
<style>
    .first-row
    {
        border-top: 2px solid #4c667f !important;
    }
</style>

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Permissions</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">                    
                    <li class="breadcrumb-item">System Manager</li>
                    <li class="breadcrumb-item">Permissions</li>
                    <li class="breadcrumb-item active">Assign</li>
                </ol>
            </div>

        </div>
    </div>
</div>

<form action="{{ route($routePrefix . '.assign') }}" method="POST">
    <div class="row">
        <div class="col-lg-9">            
            {!! csrf_field() !!}            
            <div class="row mb-4">
                <label class="col-sm-3 col-form-label" style="text-align:right;">Role</label>
                <div class="col-sm-8">
                    <select id="role_id" name="role_id" class ="form-control select2" required="required">                        
                        <option value="">Please Select</option>
                        @foreach($role_list as $k => $t)                            
                            <option value="{{ $k }}">{{$t}}</option>
                        @endforeach
                    </select>
                </div>            
            </div>
            
            <div class="row mb-4">
                <div class="offset-lg-2" id="permission_block"></div>
            </div>
            <div class="mt-4 offset-md-4">
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function()
    {
        $("select#role_id").change(function()
        {
            var id = $(this).val();

            var v = $(this).val();
            v = v ? v : 0;
            
            if ($("#permission_block").not(":empty").length > 0)
            {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You have change permissions but did not save it, Are you sure to ignore changes",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: constants.swal.button.confirm_color,
                    cancelButtonColor: constants.swal.button.cancel_color,
                    confirmButtonText: "Yes"   
                }).then(function(e) {
                    if (e.value)
                    {
                        $("#permission_block").html("");
                        if (v)
                        {
                            $("#permission_block").load("/admin/permissions/ajax_get_permissions/" + v);
                        }
                    }
                });
            }
            else
            {
                $("#permission_block").html("");
                if (v)
                {
                    $("#permission_block").load("/admin/permissions/ajax_get_permissions/" + v);
                }
            }
        });

        $("form").submit(function()
        {
            var len = $("input.aco_action").length;

            if (len <= 0)
            {
                $("select#role_id").trigger("change");
                return false;
            }

            var check_len = $("input.aco_action:checked").length;

            if (check_len <= 0)
            {
                Swal.fire(
                    'Error!',
                    'Please Select At Least One Checkbox',
                    'error'
                )

                return false;
            }
        });
    });
</script>

@endsection
