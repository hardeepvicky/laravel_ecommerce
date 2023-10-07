@extends($layout)

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Permission Summary</h4>
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">System Manager</li>
                    <li class="breadcrumb-item">Permissions</li>
                    <li class="breadcrumb-item active">Summary</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">
        <form method="GET" action="{{ route($routePrefix . '.index') }}">
            <div class="row mb-4">
                <div class="col-md-3">
                    <x-inputs.drop-down name="section_name" :value="$section_name" label="Sections" class="select2" :list="$section_list" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-field name="action_name" :value="$action_name" label="Action" />
                </div>
                <div class="col-md-3">
                    <x-inputs.drop-down name="role_id" :value="$role_id" label="Roles" class="select2" :list="$role_list" />
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-3">
                    <div>
                        <button type="submit" class="btn btn-primary w-md">Search</button>
                        <span class="btn btn-light w-md clear_form_search_conditions">Clear</span>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@if(isset($records))
<div class="card">
    <div class="card-body">
        <table class="table table-striped table-bordered table-hover mb-0 sr-data-table">
            <thead>
                <tr>
                    <th class="text-center" data-sr-data-table-search-clear="1">#</th>
                    <th data-sr-data-table-search="1">Section</th>
                    <th data-sr-data-table-search="1">Action</th>
                    <th data-sr-data-table-search="1">Role</th>
                    <th>Info</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $i => $record)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $record['section'] ?? "" }}</td>
                    <td>{{ $record['action'] ?? "" }}</td>
                    <td>{{ $record['role']['name'] }}</td>
                    <td>{{ $record['info'] }}</td>
                    <td>
                        @if ($record['can_be_delete'])
                        <button class="btn btn-danger delete-btn" data-id="{{ $record['id'] }}">
                            <i class="bx bx-trash label-icon"></i>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<script type="text/javascript">
    $(document).ready(function() {
        $("button.delete-btn").click(function() {
            var _tr = $(this).closest("tr");

            var id = $(this).data("id");

            var url = "{{ route($routePrefix . '.ajax_delete') }}";

            var requestJson = {
                ids: [id]
            };

            $.post(url, requestJson, function(response) {
                ajaxHandleResponse(url, response, function(responseJson) {
                    _tr.remove();
                });
            });

            return false;
        });
    });
</script>

@endsection