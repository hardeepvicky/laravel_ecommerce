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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                    <li class="breadcrumb-item">Permission</li>
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
                    <select name="role_id" class ="form-control select2" required="required">                        
                        <option value="">Please Select</option>
                        @foreach($role_list as $k => $t)                            
                            <option value="{{ $k }}">{{$t}}</option>
                        @endforeach
                    </select>
                </div>            
            </div>
            
            <div class="row mb-4">
                <div class="offset-lg-2">
                    <table class="table table-striped table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Section</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach($sections as $section_name => $actions)
                                @php
                                    $section_name = trim($section_name);
                                    $section_name_str = str_replace(" ", "_", $section_name);
                                    
                                    $a = 0;
                                @endphp
                                
                                @foreach($actions as $action_name => $route_list)
                                    @php
                                        $a++;
                                        $i++;
                                        $tr_cls = $a == 1 ? "first-row" : "";
                                    @endphp
                                    <tr class="{{ $tr_cls }}">
                                        <td class="text-center">{{ $i }}</td>
                                        <td>
                                            <?php if ($a == 1): ?>
                                                <label>
                                                    <input type="checkbox" class="chk-select-all" data-sr-chkselect-children="input.section-<?= $section_name_str ?>">
                                                    <b><?= $section_name ?></b>
                                                </label>
                                            <?php else: ?>
                                                <?= $section_name ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <label>
                                                <input type="checkbox"                                             
                                                    class="section-<?= $section_name_str ?>" 
                                                    name="data[<?= $section_name ?>][]" 
                                                    value="<?= $action_name ?>"
                                                    />
                                                <?= $action_name ?>
                                            </label>
                                        </td>                            
                                    </tr>
                                @endforeach    
                            @endforeach    
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="mt-4 offset-md-4">
                <button type="submit" class="btn btn-primary w-md">Submit</button>
            </div>
        </div>
    </div>
</form>

@endsection
